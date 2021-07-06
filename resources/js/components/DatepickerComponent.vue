<template>
    <datepicker
        :value="defaultdate"
        :format="this.DatePickerFormat"
        :name="name"
        :language="ja"
        input-class="form-control bg-white"
        :highlighted="highlighted"
    >
    </datepicker>
</template>

<script>
import datepicker from "vuejs-datepicker";
import { ja } from "vuejs-datepicker/dist/locale";

export default {
    components: {
        datepicker
    },
    props: {
        name: {
            type: String,
            required: true
        },
        defaultdate: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            DatePickerFormat: "yyyy/MM/dd",
            ja: ja,
            highlighted: {
                days: [6, 0]
            }
        };
    }
};
</script>