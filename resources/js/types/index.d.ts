import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    role: string;
    office: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Office {
    id: number;
    name: string;
    code: string;
    description: string;
    phone: string;
    email: string;
}

export interface OfficeForm {
    name: string;
    code: string;
    description: string;
    phone: string;
    email: string;
}


export interface Complaint {
  id: number
  office: {
    name: string
  }
  category: {
    name: string
  }
  subject: string
  description: string
  status: string
  created_at: string
}

export interface ComplaintForm {
    subject: string;
    description: string;
    category_id: number | null;
    office_id: number | null;
    anonymous: boolean;
    attachments: File[];
}


export type BreadcrumbItemType = BreadcrumbItem;
