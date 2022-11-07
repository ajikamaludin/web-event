import React, { useState, useEffect } from 'react'
import { Head } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia'
import { usePrevious } from 'react-use'
import { toast } from 'react-toastify'

import { useModalState } from '@/Hooks'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Pagination from '@/Components/Pagination'
import ModalConfirm from '@/Components/ModalConfirm'
import FormModal from './FormModal'
import { formatIDR } from '@/utils'

export default function Ticket(props) {
    const { data: tickets, links } = props.tickets

    const [search, setSearch] = useState('')
    const preValue = usePrevious(search)

    const [ticket, setTicket] = useState(null)
    const formModal = useModalState(false)
    const toggle = (ticket = null) => {
        setTicket(ticket)
        formModal.toggle()
    }

    const confirmModal = useModalState(false)
    const handleDelete = (ticket) => {
        confirmModal.setData(ticket)
        confirmModal.toggle()
    }

    const onDelete = () => {
    const ticket = confirmModal.data
    if(ticket != null) {
        Inertia.delete(route('tickets.destroy', ticket), {
            onSuccess: () => toast.success('The Data has been deleted'),
        })
    }
    }

    useEffect(() => {
        if (preValue) {
            Inertia.get(
                route(route().current()),
                { q: search },
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
            <Head title="Users" />
            <div className="flex flex-col w-full sm:px-6 lg:px-8 space-y-2">
                <div className="card bg-base-100 w-full">
                    <div className="card-body">
                        <div className="flex w-full mb-4 justify-between">
                            <div
                                className="btn btn-neutral"
                                onClick={() => toggle()}
                            >
                                Tambah
                            </div>
                            <div className="form-control">
                                <input
                                    type="text"
                                    className="input input-bordered"
                                    value={search}
                                    onChange={(e) =>
                                        setSearch(e.target.value)
                                    }
                                    placeholder="Search"
                                />
                            </div>
                        </div>
                        <div className="overflow-x-auto">
                            <table className="table w-full table-zebra">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {tickets?.map((ticket) => (
                                        <tr key={ticket.id}>
                                            <td>{ticket.name}</td>
                                            <td>{formatIDR(ticket.price)}</td>
                                            <td className="text-right">
                                                <div
                                                    className="btn btn-primary mx-1"
                                                    onClick={() =>
                                                        toggle(ticket)
                                                    }
                                                >
                                                    Edit
                                                </div>
                                                <div
                                                    className="btn btn-secondary mx-1"
                                                    onClick={() =>
                                                        handleDelete(ticket)
                                                    }
                                                >
                                                    Delete
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                        <Pagination links={links} />
                    </div>
                </div>
            </div>
            
            <FormModal
                isOpen={formModal.isOpen}
                toggle={toggle}
                ticket={ticket}
            />
            <ModalConfirm
                isOpen={confirmModal.isOpen}
                toggle={confirmModal.toggle}
                onConfirm={onDelete}
            />
        </AuthenticatedLayout>
    )
}