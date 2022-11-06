import React, { useEffect, useState } from 'react'
import { Head, Link } from '@inertiajs/inertia-react'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { useModalState } from '@/Hooks'
import ModalForm from './ModalForm'


export default function Index(props) {
    const { contents } = props
    console.log(contents)

    const [content, setContent] = useState(null)
    const formModal = useModalState(false)
    const handleEdit = (content) => {
        setContent(content)
        formModal.toggle()
    }

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            flash={props.flash}
        >
            <Head title="Halaman" />
            <div className="flex flex-col w-full sm:px-6 lg:px-6 space-y-2">
                <div className="card bg-base-100 w-full">
                    <div className="card-body">
                        <div className="overflow-x-auto pb-20">
                            <table className="table w-full table-zebra break-all">
                                <thead>
                                    <tr>
                                        <th>Content</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {contents.map(content => (
                                        <tr key={content.id}>
                                            <td>
                                                {content.type === "TEXT" || content.type === "URL" ? (
                                                    <div dangerouslySetInnerHTML={{__html: content.content}} />
                                                ) : null}
                                                {content.type === "IMAGE" || content.type === "MULTI_IMAGE" ? (
                                                    <div>
                                                        <img className='object-fit h-20' src={content.image_url}/>
                                                    </div>
                                                ) : null}
                                            </td>
                                            <td className='text-right'>
                                                <div className='btn w-20' onClick={() => handleEdit(content)}>Edit</div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            <ModalForm
                isOpen={formModal.isOpen}
                toggle={formModal.toggle}
                content={content}
            />
        </AuthenticatedLayout>
    )
}