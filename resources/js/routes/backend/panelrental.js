export const PanelRental = [
    {
        name: "manage panel rental",
        path: "/managepanelrental",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRental.vue"),
    },
    {
        name: "manage panel rental add",
        path: "/managepanelrental/add",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalAdd.vue"),
    },
    {
        name: "manage panel rental add step two",
        path: "/managepanelrental/addsteptwo",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalAddSteptwo.vue"),
    },
    {
        name: "manage panel rental Edit",
        path: "/managepanelrental/edit",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalEdit.vue"),
    },
    {
        name: "manage panel rental Edit step two",
        path: "/managepanelrental/editsteptwo",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalEditSteptwo.vue"),
    },
    {
        name: "manage panel rental Renew",
        path: "/managepanelrental/renew",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalRenew.vue"),
    },
    {
        name: "manage panel rental Renew step two",
        path: "/managepanelrental/renewsteptwo",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalRenewSteptwo.vue"),
    },
    {
        name: "manage panel rental detail",
        path: "/managepanelrental/detail",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalDetail.vue"),
    },
    {
        name: "manage panel rental success",
        path: "/managepanelrentalsuccess",
        component: () =>
            import("@/js/components/Admin/ManagePanelRental/ManagePanelRentalSuccess.vue"),
    },
];
