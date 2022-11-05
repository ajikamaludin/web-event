import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/inertia-react';
import { toast } from 'react-toastify'
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';


export default function Setting(props) {
    const { setting } = props
    const { data, setData, post, processing, errors, reset } = useForm({
        midtrans_server_key: setting.midtrans_server_key,
        midtrans_client_key: setting.midtrans_client_key,
        midtrans_merchant_id: setting.midtrans_merchant_id,
        site_name: setting.site_name,
        ticket_price: setting.ticket_price,
        is_production: +setting.is_production === 1 ? true : false,
        is_open_order: setting.is_open_order,
        term_url: setting.term_url,
    });

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('setting.update'), {
            onError: () => toast.error('please recheck the data')
        });
    };

    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            flash={props.flash}
        >
            <Head title="Setting" />


            <div className="flex flex-col w-full px-6 lg:px-8 space-y-2">
                <div className="card bg-base-100 w-full">
                    <div className="card-body">
                        <p className='font-bold text-2xl mb-4'>Setting</p>
                        <div className="overflow-x-auto">
                        <form onSubmit={submit}>
                            <div>
                                <InputLabel forInput="site_name" value="Web Title" />
                                <TextInput
                                    type="text"
                                    name="site_name"
                                    value={data.site_name}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.site_name}
                                />
                                <InputError message={errors.site_name}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="ticket_price" value="Harga Tiket" />
                                <TextInput
                                    type="text"
                                    name="ticket_price"
                                    value={data.ticket_price}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.ticket_price}
                                />
                                <InputError message={errors.ticket_price}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="term_url" value="URL syarat dan ketentuan" />
                                <TextInput
                                    type="text"
                                    name="term_url"
                                    value={data.term_url}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.term_url}
                                />
                                <InputError message={errors.term_url}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="midtrans_server_key" value="Midtrans Server Key" />
                                <TextInput
                                    type="text"
                                    name="midtrans_server_key"
                                    value={data.midtrans_server_key}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.midtrans_server_key}
                                />
                                <InputError message={errors.midtrans_server_key}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="midtrans_client_key" value="Midtrans Client Key" />
                                <TextInput
                                    type="text"
                                    name="midtrans_client_key"
                                    value={data.midtrans_client_key}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.midtrans_client_key}
                                />
                                <InputError message={errors.midtrans_client_key}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="midtrans_merchant_id" value="Midtrans Merchant Id" />
                                <TextInput
                                    type="text"
                                    name="midtrans_merchant_id"
                                    value={data.midtrans_merchant_id}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    handleChange={onHandleChange}
                                    isError={errors.midtrans_merchant_id}
                                />
                                <InputError message={errors.midtrans_merchant_id}/>
                            </div>
                            <div className='mt-4'>
                                <InputLabel forInput="midtrans_callback" value="Midtrans Payment Notification URL" />
                                <TextInput
                                    type="text"
                                    name="midtrans_callback"
                                    value={route('midtrans.callback')}
                                    className="mt-1 block w-full"
                                    autoComplete={"false"}
                                    readOnly={true} 
                                />
                            </div>
                            <div className="form-control mt-4">
                                <label className="flex space-x-2 cursor-pointer">
                                    <input 
                                        name='is_production'
                                        type="checkbox"
                                        checked={data.is_production}
                                        onChange={onHandleChange}
                                    />
                                    <span className="label-text">Midtrans Enable Production</span> 
                                </label>
                            </div>
                            <div className="flex items-center justify-between mt-4">
                                <PrimaryButton processing={processing}>
                                    Simpan
                                </PrimaryButton>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
