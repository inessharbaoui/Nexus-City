new Vue({
    el: "#app",
    data: {
        isDropdownOpen: false,
    },
    methods: {
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
    },
});
