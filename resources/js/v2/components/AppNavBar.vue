<template>
  <div class="navbar" :class="{ 'is-no-drawer': noDrawer, 'is-staff': staff }">
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    noDrawer: {
      type: Boolean,
      default: false
    },
    staff: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.navbar {
  align-items: center;
  background: $color-bg-white;
  box-shadow: 0 0 0.5rem rgba($color-text, 0.15);
  display: flex;
  height: $navbar-height;
  left: $drawer-width;
  padding: 0 $spacing;
  position: fixed;
  right: 0;
  top: 0;
  z-index: $z-index-navbar;
  &.is-no-drawer {
    left: 0;
    width: 100%;
  }
  &.is-staff {
    background: $color-text;
    color: #fff;
  }

  @media screen and (max-width: $breakpoint-drawer-narrow) {
    left: $drawer-width-narrow;
  }
  @media screen and (max-width: $breakpoint-drawer-hide) {
    left: 0;
    width: 100%;
  }
  &-brand {
    color: $color-text;
    // ↓ナビバーがもつpaddingを打ち消すネガティブマージン
    margin-left: -$spacing;
    padding: $spacing;
    &:hover,
    &:active,
    &:focus {
      color: $color-text;
      text-decoration: none;
    }
  }
  &.is-staff &-brand {
    color: #fff;
    &:hover,
    &:active,
    &:focus {
      color: #fff;
    }
  }
}
</style>
