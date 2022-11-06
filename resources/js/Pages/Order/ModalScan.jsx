import React, { useEffect, useState } from 'react'
import InputLabel from '@/Components/InputLabel'
import TextInput from '@/Components/TextInput'
import axios from 'axios'

export default function ModalScan(props) {
    const { isOpen, toggle } = props
    const [q, setQ] = useState('')
    const [response, setResponse] = useState({status: '', message: ''})
    const [loading, setLoading] = useState(false)

    const search = () => {
        setLoading(true)
        axios.post(route('orders.check'), {order_id: q})
        .then(res => {
            setResponse({
                status: 'ok',
                message: res.data.message
            })
        })
        .catch(err => {
            setResponse({
                status: 'err',
                message: err.response.data.message
            })
        })
        .finally(() => {
            setLoading(false)
            setQ('')
        })
    }

    useEffect(() => {
        setQ('')
        setResponse({status: '', message: ''})
    }, [isOpen])

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
            <div className="modal-box">
            <label htmlFor="my-modal-3" className="btn btn-sm btn-circle absolute right-2 top-2" onClick={toggle}>✕</label>
                <div className='mt-4'>
                    <InputLabel value="Scan Tiket" />
                    <TextInput
                        type="text"
                        value={q}
                        className="mt-1 block w-full"
                        autoComplete={"off"}
                        handleChange={(e) => setQ(e.target.value)}
                        isError={""}
                    />
                    {response.status === 'ok' ? (
                        <div className="alert alert-success shadow-lg mt-4">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" className="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>Berhasil ditukarkan!</span>
                            </div>
                        </div>
                    ) : null}
                    
                    {response.status === 'err' ? (
                    <div className="alert alert-error shadow-lg mt-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" className="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Error! {response.message}.</span>
                        </div>
                    </div>
                    ) : null}
                    <button disabled={loading} className='btn mt-4'  onClick={search}>Cari</button>
                </div>
            </div>
        </div>
    )
}