import React, { useEffect } from 'react'
import { useForm } from '@inertiajs/inertia-react'
import { toast } from 'react-toastify'

export default function FormModal(props) {
    const { isOpen, toggle = () => {} , ticket = null } = props

    const { data, setData, post, put, processing, errors, reset, clearErrors } = useForm({
        name: '',
        price: '',
    })

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.value)
    }

    const handleReset = () => {
        reset()
        clearErrors()
    }

    const handleCancel = () => {
        handleReset()
        toggle()
    }

    const handleSubmit = () => {
        if(ticket !== null) {
            put(route('tickets.update', ticket), {
                onSuccess: () =>
                    Promise.all([
                        handleReset(),
                        toggle(),
                        toast.success('The Data has been changed'),
                    ]),
            })
            return
        }
        post(route('tickets.store'), {
            onSuccess: () =>
                Promise.all([
                    handleReset(),
                    toggle(),
                    toast.success('The Data has been saved'),
                ]),
        })
    }

    useEffect(() => {
        setData({
            name: ticket?.name,
            price: ticket?.price,
        })
    }, [ticket])

    return (
        <div
            className="modal modal-bottom sm:modal-middle pb-10"
            style={
                isOpen
                    ? {
                          opacity: 1,
                          pointerEvents: 'auto',
                          visibility: 'visible',
                          overflowY: 'initial',
                      }
                    : {}
            }
        >
            <div className="modal-box overflow-y-auto max-h-screen">
                <h1 className="font-bold text-2xl pb-8">Tiket</h1>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Nama</span>
                    </label>
                    <input
                        type="text"
                        placeholder="nama"
                        className={`input input-bordered ${
                            errors.name && 'input-error'
                        }`}
                        name="name"
                        value={data.name}
                        onChange={handleOnChange}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.name}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Harga</span>
                    </label>
                    <input
                        type="text"
                        placeholder="price"
                        className={`input input-bordered ${
                            errors.price && 'input-error'
                        }`}
                        name="price"
                        value={data.price}
                        onChange={handleOnChange}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.price}</span>
                    </label>
                </div>
                <div className="modal-action">
                    <div
                        onClick={handleSubmit}
                        className="btn btn-primary"
                        disabled={processing}
                    >
                        Simpan
                    </div>
                    <div
                        onClick={handleCancel}
                        className="btn btn-secondary"
                        disabled={processing}
                    >
                        Batal
                    </div>
                </div>
            </div>
        </div>
    )
}