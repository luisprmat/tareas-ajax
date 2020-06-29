<template>
    <i :class="cssClasses"></i>
</template>

<script>
export default {
    props: ['img'],
    computed: {
        cssClasses() {
            var css;

            switch (this.img) {
                case 'edit':
                    css = 'fas fa-edit';
                    break;
                case 'trash':
                    css = 'fas fa-trash-alt';
                    break;
                case 'ok':
                    css = 'fas fa-check';
                    break;
                case 'remove':
                    css = 'fas fa-times';
                    break;
                case 'unchecked':
                    css = 'far fa-square';
                    break;
                case 'check':
                    css = 'far fa-check-square';
                    break;
                default:
                    css = '';
                    break;
            }
            return css + ' fa-fw';
        }
    }
}
</script>

<style lang="scss">

</style>
