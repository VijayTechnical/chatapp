<template>
  <div class="composer">
    <textarea
      v-model="message"
      @keydown.enter="send"
      placeholder="Enter a message..."
    ></textarea>
    <button @click="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      message: "",
    };
  },
  methods: {
    send(e) {
      e.preventDefault();
      if (this.message === "") {
        return;
      }
      this.$emit("send", this.message);
      this.message = "";
    },
  },
};
</script>

<style lang="scss" scoped>
.composer {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  textarea {
    width: 90%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 1px;
    outline: none;
  }
  .btn {
    padding: 10px 18px;
    font-family: sans-serif;
    font-weight: bold;
    font-size: 16px;
  }
}
</style>
