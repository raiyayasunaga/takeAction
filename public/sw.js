self.addEventListener('push', e => {    // プッシュ通知された時

  const json = e.data.json();
  const title = json.title;
  const options = {
      body: json.body,
      data: {
          url: json.data.url,
      }
  };
  e.waitUntil(
      self.registration.showNotification(title, options)
  );

});
self.addEventListener('notificationclick', e => {   // 通知がクリックされた時

  const data = e.notification.data;
  e.waitUntil(
      clients.openWindow(data.url)
  );

});