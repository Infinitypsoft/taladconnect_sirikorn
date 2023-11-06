export const MeterWater = [
  {
    name: 'meterwater',
    path: '/managemeterwater',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageMeterWaters.vue'),
  },
  {
    name: 'waterbillcycle',
    path: '/managemeterwater/billcycle',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycle.vue'),
  },
  {
    name: 'waterbillcycleadd',
    path: '/managemeterwater/billcycle/add',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycleAdd.vue'),
  },
  {
    name: 'waterbillcycledetailbillrenter',
    path: '/managemeterwater/billcycle/renterdetailbill',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycleDetailBillRenterDetail.vue'),
  },
  {
    name: 'waterbillcycledetailbill',
    path: '/managemeterwater/billcycle/detailbill',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycleDetailBill.vue'),
  },
  {
    name: 'waterbillcycleinsertmeterwaterbill',
    path: '/managemeterwater/billcycle/insertmeterwaterbill',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycleInsertMeterWaterBill.vue'),
  },
  {
    name: 'waterbillcycleinsertmeterwaterbilldetail',
    path: '/managemeterwater/billcycle/insertmeterwaterbilldetail',
    component: () => import('@/js/components/Admin/ManageMeterWaters/ManageWaterBillCycleInsertMeterWaterBillDetail.vue'),
  },
];