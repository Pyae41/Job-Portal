// location
import LocationView from '../../views/location/LocationView.vue';
import AddLocationView from '../../views/location/AddLocationView.vue';
import EditLocationView from '../../views/location/EditLocationView.vue';


export const location = [
    {
        path: '',
        component: LocationView,
        name: 'location.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/add',
        component: AddLocationView,
        name: 'location.add',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:id/edit',
        component: EditLocationView,
        name: 'location.edit',
        meta: {
            requiresAuth: true,
        }
    }
];
