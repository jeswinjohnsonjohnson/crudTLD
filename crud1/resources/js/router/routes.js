export const routes = [
    {
        path:'/',
        component: ()  => import('./views/Auth/login'),
        name:'login',
    },
    {
        path:'/register',
        component: ()  => import('./views/Auth/register'),
        name:'register',
    },
    {
        path:'/logout',
        component: ()  => import('./views/Auth/logout'),
        name:'logout',
        
    },


    {
        path:'/employee',
        component: ()  => import('./views/Employee/employee'),
        name:'employee',
        meta:{
            requiresAuth:true
        }
    },
    {
        path:'/add',
        component: ()  => import('./views/Employee/store'),
        name:'add-employee',
        meta:{
            requiresAuth:true
        }
    },
    
    {
        path:'/update/:id',
        component: ()  => import('./views/Employee/store'),
        name:'update-employee',
         meta:{
            requiresAuth:true
        }
    },
    
    {
        path:'/update',
        component: ()  => import('./views/Employee/store'),
        name:'update',
         meta:{
            requiresAuth:true
        }
    },
    

    
]
