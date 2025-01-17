import Checkbox from "@/Components/Checkbox";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import GuestLayout from "@/Layouts/GuestLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("login"), {
            onSuccess: (response) => {
                reset("password");

                // Redirect based on role
                const userRole = response.props.auth.user.role;
                if (userRole === "admin") {
                    window.location.href = "/admin/dashboard";
                } else if (userRole === "chef") {
                    window.location.href = "/chef/dashboard";
                } else if (userRole === "manager") {
                    window.location.href = "/manager/dashboard";
                } else {
                    window.location.href = "/";
                }
            },
            onError: () => {
                console.log("Login failed, check the errors");
            },
        });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            <div className="max-w-md mx-auto bg-white rounded-lg p-6 shadow-md">
                {/* Status Message */}
                {status && (
                    <div className="mb-4 text-sm font-medium text-white bg-orange-500 rounded-md p-2 text-center">
                        {status}
                    </div>
                )}

                <form onSubmit={submit}>
                    {/* Email Field */}
                    <div>
                        <InputLabel htmlFor="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full p-3 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                            autoComplete="username"
                            isFocused={true}
                            onChange={(e) => setData("email", e.target.value)}
                        />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    {/* Password Field */}
                    <div className="mt-4">
                        <InputLabel htmlFor="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full p-3 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                            autoComplete="current-password"
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                        />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    {/* Remember Me */}
                    <div className="mt-4 block">
                        <label className="flex items-center">
                            <Checkbox
                                name="remember"
                                checked={data.remember}
                                onChange={(e) =>
                                    setData("remember", e.target.checked)
                                }
                            />
                            <span className="ms-2 text-sm text-gray-600">
                                Remember me
                            </span>
                        </label>
                    </div>

                    {/* Forgot Password & Submit */}
                    <div className="mt-6 flex items-center justify-between">
                        {canResetPassword && (
                            <Link
                                href={route("password.request")}
                                className="text-sm text-orange-600 hover:underline"
                            >
                                Forgot your password?
                            </Link>
                        )}

                        <PrimaryButton
                            className="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg focus:ring-4 focus:ring-orange-300"
                            disabled={processing}
                        >
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </GuestLayout>
    );
}
