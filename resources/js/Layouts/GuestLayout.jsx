import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#170801] ">
            <div>
                <Link href="/">
                    <ApplicationLogo className="w-32 h-32 rounded-full bg-[#170801] flex items-center justify-center" />
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-black shadow-md overflow-hidden sm:rounded-lg ">
                {children}
            </div>
        </div>
    );
}
