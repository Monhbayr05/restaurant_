import React from 'react';
import { Link, Head } from '@inertiajs/react';
import logoImage from '../Components/logo.png';


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
            <div className=" min-h-screen bg-black text-black/50 dark:bg-black dark:text-white/50 text-[#F4D7BE]">
                
                <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                    <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <header className="grid grid-cols-2 items-center gap-2 py-6 lg:grid-cols-3">
                            <div className="flex lg:justify-center lg:col-start-2">
                             
                            </div>
                            <nav style={{ color: '#f79e6e' }}  className="-mx-3 flex flex-1 justify-end">
                                {auth.user ? (
                                    <Link
                                        style={{ color: '#f79e6e' }} 
                                        href={route('dashboard')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            style={{ color: '#f79e6e' }} 
                                            href={route('login')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            style={{ color: '#f79e6e' }} 
                                            href={route('order')}
                                            active={route().current('order')}
                                            className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Order
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </header>

                        <main className="mt-1">
                            <div className="flex flex-col items-center min-h-screen p-4">
                                <div className="text-center mt-8">
                                    <div className="flex justify-center mb-4">
                                    {/* Placeholder for logo image */}
                                        <div className="w-32 h-32 rounded-full bg-[#170801] flex items-center justify-center">
                                            <img src={logoImage} alt="Logo" className="w-full h-full object-cover rounded-full" />
                                        </div> 
                                    </div>
                                    <div className="text-5xl font-bold">FoodBazalt</div>
                                    <div className="text-2xl mt-2 text-[#B0C3C7]"><h2>Where Flavor Meets Innovation</h2></div>
                                </div>

                                {/* Menu Section */}
                                <div className="flex justify-center mt-10 space-x-4">
                                    <div className="flex flex-col items-center justify-center bg-[#f79e6e] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                                    
                                        <i className="bi bi-qr-code mb-2 text-6xl"></i>
                                        <span>Цэс харах</span>
                                    </div>
                                    <div className="flex flex-col items-center justify-center bg-[#f79e6e] text-[#495C61] w-48 h-48 rounded-lg text-lg font-semibold">
                                    
                                        <i className="bi bi-basket3 mb-2 text-6xl"></i>
                                        <span>Авч явах</span>
                                    </div>
                                </div>

                                
                            </div>
                        </main>

                        {/* Footer */}
                        <footer className="py-4">
                            <div className="navbar sticky flex justify-around w-full text-center text-lg text-[#f79e6e] not-italic border border-[#f7c109] rounded-3xl p-4">
                                <ul className="flex space-x-8">
                                    <li>
                                        <a href="" className="transition-transform duration-200 transform hover:scale-110">
                                            <i className="bi bi-house-door-fill text-2xl text-[#f79e6e] not-italic"> HOME</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" className="transition-transform duration-200 transform hover:scale-110">
                                            <i className="bi bi-wallet2 text-2xl text-[#f79e6e] not-italic"> ХЭТЭВЧ</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" className="transition-transform duration-200 transform hover:scale-110">
                                            <i class="bi bi-bell text-2xl text-[#f79e6e] not-italic"> МЭДЭГДЭЛ</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" className="transition-transform duration-200 transform hover:scale-110">
                                            <i class="bi bi-gear text-2xl text-[#f79e6e] not-italic"> ТОХИРГОО</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </footer>

                    </div>
                </div>
            </div>
        </>
    );
}
