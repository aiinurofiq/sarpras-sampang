import VueRouter from 'vue-router';


let routes = [{
        path: '/beranda',
        component: require('./views/dashboard').default
    },
    {
        path: '/komponen',
        component: require('./views/komponen').default
    },
    {
        path: '/berita',
        component: require('./views/berita').default
    },
    {
        path: '/galeri',
        component: require('./views/galeri').default
    },
    {
        path: '/faq',
        component: require('./views/faq').default
    },
    {
        path: '/aspek',
        component: require('./views/aspek').default
    },
    {
        path: '/atribut',
        component: require('./views/atribut').default
    },
    {
        path: '/indikator',
        component: require('./views/indikator').default
    },
    {
        path: '/sekolah',
        component: require('./views/sekolah').default
    },
    {
        path: '/ptk',
        component: require('./views/ptk').default
    },
    {
        path: '/instrumen',
        component: require('./views/instrumen').default
    },
    {
        path: '/pengguna',
        component: require('./views/users').default
    },
    {
        path: '/kuisioner',
        component: require('./views/kuisioner').default
    },
    {
        path: '/detil-pengisian-kuisioner/:id',
        name: 'detil_pengisian',
        component: require('./views/detil-pengisian-kuisioner').default
    },
    {
        path: '/proses-pengisian-kuisioner/:id',
        name: 'proses_pengisian',
        component: require('./views/proses-pengisian-kuisioner').default
    }
];


export default new VueRouter({
    path: '/app',
    component: require('./views/dashboard').default,
    base: '/app/',
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});