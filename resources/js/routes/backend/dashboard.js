export const Dashboard = [{
  name: 'dashboard',
  path: '/dashboard',
  component: () => import('@/js/components/Admin/Dashboard/Dashboard.vue'),
},
// Seo
{
  name: 'Seo',
  path: '/seo',
  component: () => import('@/js/components/Admin/SEO/Seo.vue'),
}, {
  name: 'Seo Edit',
  path: '/seo/edit',
  component: () => import('@/js/components/Admin/SEO/SeoEdit.vue'),
},
// Slide
{
  name: 'Slide',
  path: '/slide',
  component: () => import('@/js/components/Admin/SlidePage/SlidePage.vue'),
}, {
  name: 'Slide Add',
  path: '/slide/add',
  component: () => import('@/js/components/Admin/SlidePage/SlidePageAdd.vue'),
}, {
  name: 'Slide Edit',
  path: '/slide/edit',
  component: () => import('@/js/components/Admin/SlidePage/SlidePageEdit.vue'),
},
// Manage Content
{
  name: 'Manage Content',
  path: '/managecontent',
  component: () => import('@/js/components/Admin/ManageContent/ManageContent.vue'),
}, {
  name: 'Manage Content Eng Add',
  path: '/managecontent/eng_add',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentEngAdd.vue'),
}, {
  name: 'Manage Content Eng Edit',
  path: '/managecontent/eng_edit',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentEngEdit.vue'),
}, {
  name: 'Manage Content Thai Add',
  path: '/managecontent/thai_add',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentThaiAdd.vue'),
}, {
  name: 'Manage Content Thai Edit',
  path: '/managecontent/thai_edit',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentThaiEdit.vue'),
}, {
  name: 'Manage Content Seo',
  path: '/managecontent/manage_seo',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentManageSeo.vue'),
}, {
  name: 'Manage Content Seo Edit',
  path: '/managecontent/manage_seo_edit',
  component: () => import('@/js/components/Admin/ManageContent/ManageContentManageSeoEdit.vue'),
},
// Manage Contact
{
  name: 'Manage Contact',
  path: '/managecontact',
  component: () => import('@/js/components/Admin/ManageContact/ManageContact.vue'),
}, {
  name: 'Manage Contact Edit',
  path: '/managecontact/edit',
  component: () => import('@/js/components/Admin/ManageContact/ManageContactEdit.vue'),
},
// Manage Review
{
  name: 'Manage Review Market',
  path: '/managereviewmarket',
  component: () => import('@/js/components/Admin/ManageReview/ManageReviewMarket.vue'),
},
{
  name: 'Manage Review Store',
  path: '/managereviewstore',
  component: () => import('@/js/components/Admin/ManageReview/ManageReviewStore.vue'),
},

// Manage Gallery
{
  name: 'Manage Gallery',
  path: '/managegallery',
  component: () => import('@/js/components/Admin/ManageGallery/ManageGallery.vue'),
}, {
  name: 'Manage Gallery Add',
  path: '/managegallery/add',
  component: () => import('@/js/components/Admin/ManageGallery/ManageGalleryAdd.vue'),
},
// Manage Award
{
  name: 'Manage Award',
  path: '/manageaward',
  component: () => import('@/js/components/Admin/ManageAward/ManageAward.vue'),
},
// Manage Stall
{
  name: 'Manage Stall',
  path: '/managestall',
  component: () => import('@/js/components/Admin/ManageStall/ManageStall.vue'),
},
{
  name: 'Manage Stall Add',
  path: '/managestall/add',
  component: () => import('@/js/components/Admin/ManageStall/ManageStallAdd.vue'),
},
{
  name: 'Manage Stall Edit',
  path: '/managestall/edit',
  component: () => import('@/js/components/Admin/ManageStall/ManageStallEdit.vue'),
},
// Manage Renter
{
  name: 'Manage Renter',
  path: '/managerenter',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenter.vue'),
},
{
  name: 'Manage Renter Add',
  path: '/managerenter/add',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterAdd.vue'),
},
{
  name: 'Manage Renter Edit',
  path: '/managerenter/edit',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterEdit.vue'),
},
{
  name: 'Manage Renter Detail',
  path: '/managerenter/detail',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterDetail.vue'),
},
{
  name: 'Manage Renter Detail Add Thai',
  path: '/managerenter/detail/add_thai',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterDetailAddStoreThai.vue'),
},
{
  name: 'Manage Renter Detail Add Eng',
  path: '/managerenter/detail/add_eng',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterDetailAddStoreEng.vue'),
},
{
  name: 'Manage Renter Detail Add SEO',
  path: '/managerenter/detail/add_seo',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterDetailAddStoreSEO.vue'),
},
{
  name: 'Manage Renter Detail Add Edit',
  path: '/managerenter/detail/edit_thai',
  component: () => import('@/js/components/Admin/ManageRenter/ManageRenterDetailEditStoreThai.vue'),
},

// Manage market panels
{
    name: 'Manage market panels',
    path: '/managermarketpanels',
    component: () => import('@/js/components/Admin/ManagerMarketPanels/ManagerMarketPanels.vue'),
},
// ManageRentalContract
{
  name: 'Manage Rental Contract',
  path: '/managerentalcontract',
  component: () => import('@/js/components/Admin/ManageRentalContract/ManageRentalContract.vue'),
},
{
  name: 'Manage Rental Contract Edit',
  path: '/managerentalcontract/edit',
  component: () => import('@/js/components/Admin/ManageRentalContract/ManageRentalContractEdit.vue'),
},

];
