export const Users = [{
    name: 'user',
    path: '/manageuser',
    component: () => import('@/js/components/Admin/ManagerUser/ManagerUser.vue'),
  },
  {
    name: 'useradd',
    path: '/manageuser/add',
    component: () => import('@/js/components/Admin/ManagerUser/ManagerUserAdd.vue'),
  },
  {
    name: 'user edit',
    path: '/manageuser/edit',
    component: () => import('@/js/components/Admin/ManagerUser/ManagerUserEdit.vue'),
  },
  ];