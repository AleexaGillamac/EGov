import index from '@/routes/offices';
import { InertiaLinkProps } from '@inertiajs/vue3';

export interface Office {
     id: number;
     name: string;
     description: string;
}

interface props{
     index: Offices[];
}