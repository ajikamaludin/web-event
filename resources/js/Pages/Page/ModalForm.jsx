import React, { useEffect, useRef } from 'react'
import { useForm } from '@inertiajs/inertia-react'
import InputFile from '@/Components/InputFile'
import InputLabel from '@/Components/InputLabel'
import InputError from '@/Components/InputError'

const FormText = ({data, handleOnChange, errors}) => {
    return (
        <div className="form-control">
            <textarea
                className={`input input-bordered h-36 ${
                    errors.content && 'input-error'
                }`}
                name="content"
                value={data.content}
                onChange={handleOnChange}
                rows={10}
            ></textarea>
            <label className="label">
                <span className="label-text-alt">{errors.content}</span>
            </label>
        </div>
    )
}

const FormImage = ({data, setData, errors, inputRef}) => {
    return (
        <div>
            <InputLabel forInput="image" value="Gambar" />
            <InputFile  
                file={data.image} 
                isError={errors.image} 
                inputRef={inputRef} 
                handleChange={e => setData('image', e.target.files[0])}
            />
            <InputError message={errors.document}/>
        </div>
    )
}

const FormMultiImage = ({images}) => {

}

export default function ModalForm(props) {
    const inputImage = useRef()
    const { isOpen, toggle = () => {} , content = null } = props

    const { data, setData, post, processing, errors, reset, clearErrors } = useForm({
        content_name: '',
        content: '',
        type: 'TEXT',
        sort: '',
        image: '',
        images: ''
    })
    console.log(data)

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
        post(route('contents.update', content.id), {
            onSuccess: () => handleCancel()
        })
    }

    useEffect(() => {
        setData({
            content_name: content?.content_name,
            content: content?.content,
            type: content?.type,
            sort: content?.sort,
        })
    }, [content])

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
                {(data.type === 'TEXT' || data.type === 'URL') && (
                    <FormText 
                        data={data} 
                        handleOnChange={handleOnChange} 
                        errors={errors}
                    />
                )}
                {(data.type === 'IMAGE') && (
                    <FormImage 
                        data={data} 
                        setData={setData} 
                        errors={errors}
                        inputRef={inputImage}
                    />
                )}
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