<template>
  <div class="chat-component">
    <ContactsList :contacts="contacts" @selected="startConversationWith" />
    <Conversation
      :contact="selectedContact"
      :messages="messages"
      @new="saveNewMessages"
    />
  </div>
</template>

<script>
import Conversation from "./Conversation.vue";
import ContactsList from "./ContactsList.vue";
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      selectedContact: {},
      messages: [],
      contacts: [],
    };
  },
  components: { Conversation, ContactsList },
  methods: {
    startConversationWith(contact) {
      this.updateUnreadCount(contact, true);
      axios
        .get(`/conversation/${contact.id}`)
        .then((response) => {
          this.messages = response.data;
          this.selectedContact = contact;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveNewMessages(message) {
      this.messages.push(message);
    },
    handleIncoming(message) {
      if (this.selectedContact && message.from === this.selectedContact.id) {
        this.saveNewMessages(message);
        return;
      }
      this.updateUnreadCount(message.from_contact, false);
    },
    updateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map((single) => {
        if (single.id != contact.id) {
          return single;
        }

        if (reset) single.unread = 0;
        else single.unread += 1;

        return single;
      });
    },
  },
  mounted() {
    Echo.private(`messages.${this.user.id}`).listen("NewMessage", (e) => {
      this.handleIncoming(e.message);
    });
    axios
      .get("/contacts")
      .then((response) => {
        console.log(response.data);
        this.contacts = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
<style lang="scss" scoped>
.chat-component {
  display: flex;
  height: 400px;
}
</style>

