import React, {useEffect} from 'react'
import { useForm } from '@inertiajs/inertia-react'

export default function ModalForm(props) {
    const { isOpen, toggle = () => {}, order = null } = props

    const { data, setData, put, processing, errors, reset, clearErrors } = useForm({
        order_id: '',
        order_date: '',
        order_amount: '',
        order_payment: '',
        order_payment_channel: '',
        order_status: '',
        name: '',
        address: '',
        email: '',
        phone_number: '',
        is_checked: '',
        midtrans_detail_callback: '',
    })

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    }

    const handleReset = () => {
        // reset()
        clearErrors()
    }

    const handleCancel = () => {
        handleReset()
        toggle()
    }

    const handleSubmit = () => {
        put(route('orders.update', order), {
            onSuccess: () => handleCancel()
        })
    }

    useEffect(() => {
        setData({
            order_id: order?.order_id,
            order_date: order?.order_date,
            order_amount: order?.order_amount,
            order_payment: order?.order_payment,
            order_payment_channel: order?.order_payment_channel,
            order_status: order?.order_status,
            name: order?.name,
            address: order?.address,
            email: order?.email,
            phone_number: order?.phone_number,
            is_checked: order?.is_checked,
            midtrans_detail_callback: order?.midtrans_detail_callback,
        })
        console.log(order)
    }, [order])

    return (
        <div
            className="modal modal-bottom sm:modal-middle pb-10"
            style={
                isOpen
                    ? {
                          opacity: 1,
                          pointerEvents: 'auto',
                          visibility: 'visible',
                      }
                    : {}
            }
        >
            <div className="modal-box overflow-y-auto max-h-screen">
                <h1 className="font-bold text-2xl pb-4">Order</h1>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">No Order</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.order_id && 'input-error'
                        }`}
                        name="order_id"
                        value={data.order_id}
                        readOnly={true}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.order_id}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Tanggal</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.order_date && 'input-error'
                        }`}
                        name="order_date"
                        value={data.order_date}
                        readOnly={true}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.order_date}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Nama</span>
                    </label>
                    <input
                        type="text"
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
                        <span className="label-text">Email</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.email && 'input-error'
                        }`}
                        name="email"
                        value={data.email}
                        onChange={handleOnChange}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.email}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">No HP/WA</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.phone_number && 'input-error'
                        }`}
                        name="phone_number"
                        value={data.phone_number}
                        onChange={handleOnChange}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.phone_number}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Alamat</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.address && 'input-error'
                        }`}
                        name="address"
                        value={data.address}
                        onChange={handleOnChange}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.address}</span>
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Status</span>
                    </label>
                    <select 
                        className="select w-full select-bordered" 
                        value={data.order_status} 
                        onChange={handleOnChange} name="order_status"
                    >
                        <option value="2">Sudah bayar</option>
                        <option value="1">Pending</option>
                        <option value="0">Belum dibayar</option>
                    </select>
                </div>
                <div className="form-control mt-1 ml-1">
                    <label className="flex space-x-2 cursor-pointer">
                        <input 
                            name='is_checked'
                            type="checkbox"
                            checked={data.is_checked}
                            onChange={handleOnChange}
                        />
                        <span className="label-text">Sudah discan</span> 
                    </label>
                </div>
                <div className="form-control">
                    <label className="label">
                        <span className="label-text">Payment Channel</span>
                    </label>
                    <input
                        type="text"
                        className={`input input-bordered ${
                            errors.order_payment_channel && 'input-error'
                        }`}
                        name="order_payment_channel"
                        value={data.order_payment_channel}
                        readOnly={true}
                    />
                    <label className="label">
                        <span className="label-text-alt">{errors.order_payment_channel}</span>
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