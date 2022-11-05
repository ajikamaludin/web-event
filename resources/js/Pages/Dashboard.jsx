import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

export default function Dashboard(props) {
    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            flash={props.flash}
        >
            <Head title="Dashboard" />

            <div className='max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between space-x-1'>
                <div className="stats bg-base-100 border-base-300 border md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Kunjugan Bulan Ini</div> 
                        <div className="stat-value">1,400</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Kunjugan Hari ini</div> 
                        <div className="stat-value">2,400</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Order</div> 
                        <div className="stat-value">1,400</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Order Terbayar</div> 
                        <div className="stat-value">4,400</div> 
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
