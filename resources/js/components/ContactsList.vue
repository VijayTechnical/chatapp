<template>
  <div class="contact-list">
    <ul>
      <li
        v-for="contact in sortedContacts"
        :key="contact.id"
        @click="selectContact(contact)"
        :class="{ selected: contact === selected }"
      >
        <div class="avatar">
          <img :src="contact.profile_photo_path" :alt="contact.name" />
        </div>
        <div class="contact">
          <p class="name">{{ contact.name }}</p>
          <p class="email">{{ contact.email }}</p>
        </div>
        <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
      </li>
    </ul>
    <div class="footer">
        <p>Designed and developed by <a href="#">Seshra Innovation</a></p>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    contacts: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      selected: this.contacts.length ? this.contacts[0] : null
    };
  },
  methods: {
    selectContact(contact) {
      this.selected = contact;
      this.$emit("selected", contact);
    },
  },
  computed: {
    sortedContacts() {
      return _.sortBy(this.contacts, [
        (contact) => {
            if(contact === this.selected){
                return Infinity;
            }
          return contact.unread;
        },
      ]).reverse();
    },
  },
};
</script>

<style lang="scss" scoped>
.contact-list {
  flex: 2;
  max-height: 600px;
  position: relative;
  overflow-y: scroll;
  background: #b9e1f7;
  border-right: 1px solid #a6a6a6;
  ul {
    list-style-type: none;
    padding-left: 0;
    li {
      display: flex;
      padding: 2px;
      border-bottom: 1px solid #aaaaaa;
      height: 80px;
      position: relative;
      cursor: pointer;
      &.selected {
        background: #f0f2f5;
      }

      span.unread {
        background: #82e0a8;
        color: #fff;
        position: absolute;
        right: 11px;
        top: 20px;
        display: flex;
        font-weight: 700;
        min-width: 20px;
        justify-content: center;
        align-items: center;
        line-height: center;
        font-size: 12px;
        padding: 0 4px;
        border-radius: 50%;
      }
      .avatar {
        flex: 1;
        display: flex;
        align-items: center;
        img {
          width: 50px;
          height: 50px;
          border-radius: 50%;
          margin: 0 auto;
        }
      }
      .contact {
        flex: 3;
        font-size: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        p {
          margin: 0;
          &.name {
            font-weight: bold;
          }
        }
      }
    }
  }
  .footer{
      position: absolute;
      display: flex;
      align-content: center;
      align-items: center;
      text-align: center;
      bottom: 0;
      p{
          padding: 2px;
          color: #666;
      }
  }
}
</style>
