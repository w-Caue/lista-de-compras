function sidebar() {
    return {
        sidebar: {
            full: false,
            navOpen: false
        },
        tooltip: {
            show: false,
            visibleClass: 'block sm:absolute  sm:border border-gray-500 left-16 sm:text-sm sm:bg-gray-800 sm:px-2 sm:py-1 sm:rounded'
        },
        dropdown: {
            open: false,
            toggle(tap) {
                this.open = !this.open;
            },
        },

        dropdownProduto: {
            open: false,
            toggle(tap) {
                this.open = !this.open;
            },
        },

        dropdownMovimentacao: {
            open: false,
            toggle(tap) {
                this.open = !this.open;
            },
        }
    }
}