<template>
  <div class="conversation">
    <h1>{{ contact ? contact.name : "select a contact" }}</h1>
    <MessageFeed :contact="contact" :messages="messages" />
    <MessageComposer @send="sendMessage" />
  </div>
</template>
<script>
import MessageFeed from "./MessageFeed.vue";
import MessageComposer from "./MessageComposer.vue";
export default {
  props: {
    contact: {
      type: Object,
      default: null,
    },
    messages: {
      type: Array,
      default: [],
    },
  },
  components: { MessageFeed, MessageComposer },
  methods: {
    sendMessage(text) {
      if (!this.contact) {
        return;
      }
      axios
        .post("/conversation/send", {
          contact_id: this.contact.id,
          message: text,
        })
        .then((response) => {
          this.$emit("new", response.data);
        });
    },
  },
};
</script>
<style lang="scss" scoped>
.conversation {
  flex: 5;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  h1 {
    background: #f0f2f5;
    font-size: 20px;
    padding: 10px 15px;
    margin: 0;
    border-bottom: 1px dashed lightgray;
  }
}
</style>
