<template>
  <transition name="modal" appear>
    <div class="c-modal">
      <div class="c-modal__overlay" @click.self="$emit('close')">
        <div class="c-modal__body modal-window">
          <slot/>
        <!-- /.c-modal__body --></div>
      <!-- /.c-modal__overlay --></div>
    <!-- /.c-modal --></div>
  </transition>
</template>

<style lang="scss" scoped>
.c-modal {
  &__overlay {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
  }

  &__body{
    background: #fff;
    border-radius: 4px;
    position: relative;
    z-index: 10;
    transform: translateY(-20px);
  }
}

// オーバーレイのトランジション
.modal-enter-active, .modal-leave-active {
  transition: opacity 0.4s;

  // オーバーレイに包含されているモーダルウィンドウのトランジション
  .modal-window {
    transition: opacity 0.4s, transform 0.4s;
  }
}

// ディレイを付けるとモーダルウィンドウが消えた後にオーバーレイが消える
.modal-leave-active {
  transition: opacity 0.6s ease 0.4s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
    transform: translateY(-20px);
  }
}
</style>