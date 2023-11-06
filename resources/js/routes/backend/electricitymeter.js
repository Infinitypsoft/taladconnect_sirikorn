  export const MeterElectricity = [
    {
      name: 'meterelectricity',
      path: '/managemeterelectricity',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageMeterElectricity.vue'),
    },
    {
      name: 'electricitybillcycle',
      path: '/managemeterelectricity/billcycle',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycle.vue'),
    },
    {
      name: 'electricitybillcycleadd',
      path: '/managemeterelectricity/billcycle/add',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycleAdd.vue'),
    },
    {
      name: 'electricitybillcycledetailbillrenter',
      path: '/managemeterelectricity/billcycle/renterdetailbill',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycleDetailBillRenterDetail.vue'),
    },
    {
      name: 'electricitybillcycledetailbill',
      path: '/managemeterelectricity/billcycle/detailbill',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycleDetailBill.vue'),
    },
    {
      name: 'electricitybillcycleinsertmeterelectricitybill',
      path: '/managemeterelectricity/billcycle/insertmeterelectricitybill',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycleInsertMeterElectricityBill.vue'),
    },
    {
      name: 'electricitybillcycleinsertmeterelectricitybilldetail',
      path: '/managemeterelectricity/billcycle/insertmeterelectricitybilldetail',
      component: () => import('@/js/components/Admin/ManageMeterElectricity/ManageElectricityBillCycleInsertMeterElectricityBillDetail.vue'),
    },
  ];