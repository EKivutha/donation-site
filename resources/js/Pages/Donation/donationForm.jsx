import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import ValidationErrors from '@/Components/ValidationErrors';
import { Head, Link, useForm } from '@inertiajs/inertia-react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        amount: '',
        phone_number: '',
    });

    useEffect(() => {
        return () => {
            reset('amount', 'phone_number');
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
            <Head title="Donation details" />

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>

                <div className="mt-4">
                    <Label forInput="amount" value="Amount" />

                    <Input
                        type="name"
                        name="amount"
                        value={data.amount}
                        className="mt-1 block w-full"
                        handleChange={onHandleChange}
                        required
                    />
                </div>

                <div className="mt-4">
                    <Label forInput="phone_number" value="Phone Number" />

                    <Input
                        type="name"
                        name="phone_number"
                        value={data.phone_number}
                        className="mt-1 block w-full"
                        handleChange={onHandleChange}
                        required
                    />
                </div>

                <div className="flex items-center justify-end mt-4">

                    <Button className="ml-4" processing={processing}>
                        Donate
                    </Button>
                </div>
            </form>
        </Guest>
    );
}
