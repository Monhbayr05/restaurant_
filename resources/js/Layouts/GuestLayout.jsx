import ApplicationLogo from "@/Components/ApplicationLogo";
import { Link } from "@inertiajs/react";
import back from "@/Components/Images/back.jpg";

export default function Guest({ children }) {
    return (
        <div
            className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center"
            style={{
                backgroundImage: `url(${back})`,
                backgroundSize: "contain",
                backgroundPosition: "center",
                backgroundRepeat: "repeat",
            }}
        >
            {/* Overlay for color tint */}
            <div className="absolute inset-0 bg-orange-500 bg-opacity-85"></div>

            {/* Logo Section */}

            {/* Content Section */}
            <div className="z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white bg-opacity-95 shadow-lg overflow-hidden sm:rounded-lg">
                <div className="z-10 py-6 rounded-sm bg-white px-7">
                    <Link href="/">
                        <ApplicationLogo className="w-32 h-32 rounded-full bg-white p-4 shadow-md flex items-center justify-center" />
                    </Link>
                </div>
                {children}
            </div>
        </div>
    );
}
