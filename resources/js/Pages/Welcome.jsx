import React from 'react';
import { Link, Head } from '@inertiajs/react';
// import logoImage from '../resource/js/Components/Logo';


export default function Welcome({ auth, laravelVersion, phpVersion }) {
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    return (
        <>
            <Head title="Welcome" />
            <div className="bg-white text-black/50 dark:bg-black dark:text-white/50 text-[#F4D7BE]">
                <img
                    id="background"
                    className="absolute -left-20 top-0 max-w-[877px]"
                    src="https://laravel.com/assets/img/welcome/background."
                />
                <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                    <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <header className="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                            <div className="flex lg:justify-center lg:col-start-2">
                                <div className="w-20 h-20 rounded-full bg-[#F4D7BE] flex items-center justify-center">
                                {/* <img src={logoImage} alt="Logo" /> */}
                                </div>
                            </div>
                            <nav className="-mx-3 flex flex-1 justify-end">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </header>

                        <main className="mt-6">
                            <div className="flex flex-col items-center min-h-screen p-4">
                                {/* Header */}
                                {/* <header className="flex justify-between w-full p-4">
                                    <div className="flex items-center space-x-2">
                                        <i className="icon-world"></i>
                                        <span>MN</span>
                                    </div>
                                    <div>
                                        <span>VIP</span>
                                    </div>
                                </header> */}

                                {/* Profile Section */}
                                <div className="text-center mt-8">
                                    <div className="flex justify-center mb-4">
                                    {/* Placeholder for logo image */}
                                        
                                    </div>
                                    <div className="text-5xl font-bold">FoodBazalt</div>
                                    <div className="text-2xl mt-2 text-[#B0C3C7]"><h2>Where Flavor Meets Innovation</h2></div>
                                </div>

                                {/* Menu Section */}
                                <div className="flex justify-center mt-10 space-x-4">
                                    <div className="flex flex-col items-center justify-center bg-[#F4D7BE] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                                    
                                        <i className="bi bi-qr-code mb-2 text-6xl"></i>
                                        <span>Цэс харах</span>
                                    </div>
                                    <div className="flex flex-col items-center justify-center bg-[#F4D7BE] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                                    
                                        <i className="bi bi-basket3 mb-2 text-6xl"></i>
                                        <span>Авч явах</span>
                                    </div>
                                </div>

                                
                            </div>
                        </main>

                        {/* Footer */}
                        <footer className="flex justify-around w-full mt-auto py-4">
                                <i className="icon-home text-2xl"></i>
                                <i className="icon-wallet text-2xl"></i>
                                <i className="icon-bell text-2xl"></i>
                                <i className="icon-settings text-2xl"></i>
                        </footer>
                        <footer className="py-16 text-center text-sm text-black dark:text-black/70">
                            <div className="navbar sticky">
                                <div className="navbar-start">
                                    <ul>
                                        <li>
                                            <a href="">
                                                Home Icon
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Wallet
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Notification
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </>
    );
}


