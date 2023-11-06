export const Bill = [{
    name: 'Bill',
    path: '/managebill',
    component: () => import('@/js/components/Admin/ManageBill/ManageBill.vue'),
  },
  {
    name: 'Bill Add',
    path: '/managebill/add',
    component: () => import('@/js/components/Admin/ManageBill/ManageBillAdd.vue'),
  },
  {
    name: 'Bill Edit',
    path: '/managebill/edit',
    component: () => import('@/js/components/Admin/ManageBill/ManageBillEdit.vue'),
  },
  {
    name: 'Bill Detail',
    path: '/managebill/detail',
    component: () => import('@/js/components/Admin/ManageBill/ManageBillDetail.vue'),
  },
  ];