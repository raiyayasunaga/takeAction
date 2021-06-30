<html>
<body>
    <div id="app">
        <div v-if="processing">処理中...</div>
        <div v-else>
            <button type="button" @click="subscribe" v-if="!isSubscribed">イベントのプッシュ通知を登録する</button>
            <button type="button" @click="unsubscribe" v-else>イベントのプッシュ通知を解除する</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                vapidPublicKey: '{{ config('webpush.vapid.public_key') }}',
                registration: null,
                isSubscribed: false,
                processing: false,
                csrfToken: '{{ csrf_token() }}'
            },
            methods: {
                subscribe() {   // プッシュ通知を許可する

                    this.processing = true;
                    const applicationServerKey = this.base64toUint8(this.vapidPublicKey);
                    const options = {
                        userVisibleOnly: true,
                        applicationServerKey: applicationServerKey
                    };
                    this.registration.pushManager.subscribe(options)
                        .then(subscription => {

                            // Laravel側へデータを送信
                            fetch('/web_push', {
                                method: 'POST',
                                body: JSON.stringify(subscription),
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-CSRF-Token': this.csrfToken
                                }
                            })
                            .then(response => {

                                this.isSubscribed = true;
                                alert('プッシュ通知が登録されました');

                            })
                            .catch(error => {

                                console.log(error);

                            });

                        })
                        .finally(() => {

                            this.processing = false;

                        });

                },
                unsubscribe() { // プッシュ通知を解除する

                    this.processing = true;
                    this.registration.pushManager.getSubscription()
                        .then(subscription => {
                            subscription.unsubscribe()
                                .then(result => {

                                    if(result) {

                                        this.isSubscribed = false;
                                        alert('プッシュ通知が解除されました');

                                    }

                                });
                        })
                        .finally(() => {

                            this.processing = false;

                        });

                },
                base64toUint8(str) {

                    str += '='.repeat((4 - str.length % 4) % 4);
                    const base64 = str
                        .replace(new RegExp('\-', 'g'), '+')
                        .replace(new RegExp('_', 'g'), '/');

                    const binary = window.atob(base64);
                    const binaryLength = binary.length;
                    let uint8Array = new Uint8Array(binaryLength);

                    for(let i = 0; i < binaryLength; i++) {

                        uint8Array[i] = binary.charCodeAt(i);

                    }

                    return uint8Array.buffer;
                }
            },
            mounted() {

                if('serviceWorker' in navigator && 'PushManager' in window) {

                    // Service Workerをブラウザにインストールする
                    navigator.serviceWorker.register('/sw.js')
                        .then(registration => {

                            console.log('Service Worker が登録されました。');
                            this.registration = registration;
                            this.registration.pushManager.getSubscription()
                                .then(subscription => {

                                    this.isSubscribed = !(subscription === null);

                                });

                        });

                } else {

                    console.log('このブラウザは、プッシュ通知をサポートしていません。');

                }

            }
        });

    </script>
</body>
</html>