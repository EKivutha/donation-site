import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import ValidationErrors from '@/Components/ValidationErrors';
import { Head, Link, useForm } from '@inertiajs/inertia-react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        consumer_key: '',
        consumer_secret: '',
    });

    useEffect(() => {
        return () => {
            reset('consumer_key', 'consumer_secret');
        };
    }, []);

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <Guest>
            <Head title="PesaPal mercahnt credentials" />

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>   

                <div className="mt-4">
                    <Label forInput="consumer_key" value="Consumer Key" />

                    <Input
                        type="consumer_key"
                        name="consumer_key"
                        value={data.consumer_key}
                        className="mt-1 block w-full"
                        handleChange={onHandleChange}
                        required
                    />
                </div>

                <div className="mt-4">
                    <Label forInput="consumer_secret" value="Consumer Secret" />

                    <Input
                        type="name"
                        name="consumer_secret"
                        value={data.consumer_secret}
                        className="mt-1 block w-full"
                        handleChange={onHandleChange}
                        required
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    

                    <Button className="ml-4" processing={processing}>
                        Update Pesapal Credentials
                    </Button>
                </div>
            </form>
        </Guest>
    );
}
