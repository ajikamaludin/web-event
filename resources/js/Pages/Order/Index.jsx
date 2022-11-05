import React, { useEffect, useState } from 'react'
import { usePrevious } from 'react-use'
import { Head, Link } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia'
import { toast } from 'react-toastify'
import qs from 'qs'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Pagination from '@/Components/Pagination'
import { IconMenu } from '@/Icons'
import { formatDate } from '@/utils'
import { useModalState } from '@/Hooks'
import ModalConfirm from '@/Components/ModalConfirm'
import ModalScan from './ModalScan'

export default function Index(props) {
    const { data: orders, links } = props.orders

    const [search, setSearch] = useState({q: '', is_checked: '', order_status: ''})
    const preValue = usePrevious(search)

    const confirmModal = useModalState(false)
    const handleDelete = (order) => {
        confirmModal.setData(order)
        confirmModal.toggle()
    }

    const onDelete = () => {
        const order = confirmModal.data
        if(order != null) {
            Inertia.delete(route('orders.destroy', order), {
                onSuccess: () => toast.success('The Data has been deleted'),
            })
        }
    }

    const scanModal = useModalState(false)

    const handleFilter = (filter) => {
        setSearch(filter)
    }

    const handleSelect = (e) => {
        search[e.target.name] = e.target.value
        setSearch({...search})
    }

    useEffect(() => {
        if (preValue) {
            Inertia.get(
                route(route().current()),
                search,
                {
                    replace: true,
                    preserveState: true,
                }
            )
        }
    }, [search])

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            flash={props.flash}
        >
            <Head title="Order" />
            <div className="flex flex-col w-full sm:px-6 lg:px-6 space-y-2">
                <div className="card bg-base-100 w-full">
                    <div className="card-body">
                        <div className="flex flex-col md:flex-row w-full mb-4 justify-between space-y-1 md:space-y-0">
                            <div className='flex flex-row space-x-1'>
                                <div className="form-control w-full">
                                    <input
                                        type="text"
                                        className="input input-bordered"
                                        value={search.q}
                                        onChange={(e) =>
                                            handleFilter({q: e.target.value})
                                        }
                                        placeholder="Search"
                                    />
                                </div>
                                <div className="form-control w-full">
                                    <select 
                                        className="select w-full select-bordered" 
                                        value={search.is_checked} 
                                        onChange={handleSelect} name="is_checked"
                                    >
                                        <option value="">Semua [Scan]</option>
                                        <option value="1">Sudah</option>
                                        <option value="0">Belum</option>
                                    </select>
                                </div>
                                <div className="form-control w-full">
                                    <select 
                                        className="select w-full select-bordered" 
                                        value={search.order_status} 
                                        onChange={handleSelect} 
                                        name="order_status"
                                    >
                                        <option value="">Semua [Status]</option>
                                        <option value="2">Bayar</option>
                                        <option value="1">Pending</option>
                                        <option value="0">Belum</option>
                                    </select>
                                </div>
                            </div>
                            <div className='flex space-x-1'>
                                <div className='btn btn-outline' onClick={scanModal.toggle}>Scan</div>
                                <a href={`${route('orders.export')}?${qs.stringify(search)}`} className='btn btn-outline'>Export</a>
                            </div>
                        </div>
                        <div className="overflow-x-auto pb-20">
                            <table className="table w-full table-zebra break-all">
                                <thead>
                                    <tr>
                                        <th>No.Order</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>No.HP/WA</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {orders.map(order => (
                                        <tr key={order.id}>
                                            <td>{order.order_id}</td>
                                            <td>{formatDate(order.order_date)}</td>
                                            <td>{order.name}</td>
                                            <td>{order.order_status_text}</td>
                                            <td>{order.phone_number}</td>
                                            <td className='text-right'>
                                                <div className="dropdown dropdown-left">
                                                    <label tabIndex={0} className="btn btn-sm m-1 px-1"><IconMenu/></label>
                                                    <ul tabIndex={0} className="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                                        <li onClick={() => {}}>
                                                            <div>Edit</div>
                                                        </li>
                                                        <li onClick={() => handleDelete(order)} className="bg-error ">
                                                            <div>Delete</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <Pagination links={links} params={search}/>
                        </div>
                        
                    </div>
                </div>
            </div>

            <ModalConfirm
                isOpen={confirmModal.isOpen}
                toggle={confirmModal.toggle}
                onConfirm={onDelete}
            />
            <ModalScan
                isOpen={scanModal.isOpen}
                toggle={scanModal.toggle}
            />
        </AuthenticatedLayout>
    )
}