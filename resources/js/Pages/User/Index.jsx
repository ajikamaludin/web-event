import React, { useState, useEffect } from 'react'
import { Head } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia'
import { usePrevious } from 'react-use'
import { toast } from 'react-toastify'

import { useModalState } from '@/Hooks'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import Pagination from '@/Components/Pagination'
import ModalConfirm from '@/Components/ModalConfirm'
import UserFormModal from './UserFormModal'

export default function Users(props) {
    const { data: users, links } = props.users

    const [search, setSearch] = useState('')
    const preValue = usePrevious(search)

    const [user, setUser] = useState(null)
    const formModal = useModalState(false)
    const toggle = (user = null) => {
        setUser(user)
        formModal.toggle()
    }

    const confirmModal = useModalState(false)
    const handleDelete = (user) => {
        confirmModal.setData(user)
        confirmModal.toggle()
    }

    const onDelete = () => {
    const user = confirmModal.data
    if(user != null) {
        Inertia.delete(route('users.destroy', user), {
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
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {users?.map((user) => (
                                        <tr key={user.id}>
                                            <th>{user.id}</th>
                                            <td>{user.name}</td>
                                            <td>{user.email}</td>
                                            <td className="text-right">
                                                <div
                                                    className="btn btn-primary mx-1"
                                                    onClick={() =>
                                                        toggle(user)
                                                    }
                                                >
                                                    Edit
                                                </div>
                                                {props.auth.user.id !==
                                                    user.id && (
                                                    <div
                                                        className="btn btn-secondary mx-1"
                                                        onClick={() =>
                                                            handleDelete(user)
                                                        }
                                                    >
                                                        Delete
                                                    </div>
                                                )}
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
            
            <UserFormModal
                isOpen={formModal.isOpen}
                toggle={toggle}
                user={user}
            />
            <ModalConfirm
                isOpen={confirmModal.isOpen}
                toggle={confirmModal.toggle}
                onConfirm={onDelete}
            />
        </AuthenticatedLayout>
    )
}