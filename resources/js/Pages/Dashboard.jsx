import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/inertia-react';

export default function Dashboard(props) {
    console.log(props)
    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            flash={props.flash}
        >
            <Head title="Dashboard" />

            <div className='max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between space-x-0 md:space-x-1 space-y-1 md:space-y-0'>
                <div className="stats bg-base-100 border-base-300 border w-full md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Kunjugan Bulan Ini</div> 
                        <div className="stat-value">{props.visit_month}</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border w-full md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Kunjugan Hari ini</div> 
                        <div className="stat-value">{props.visit_today}</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border w-full md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Order</div> 
                        <div className="stat-value">{props.order_total}</div> 
                    </div>
                </div>
                <div className="stats bg-base-100 border-base-300 border w-full md:w-1/4">
                    <div className="stat">
                        <div className="stat-title">Total Order Terbayar</div> 
                        <div className="stat-value">{props.order_paid}</div> 
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
