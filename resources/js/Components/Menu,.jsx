import React from "react";
import Header from "./Header";
import Category from "./Category";

export default function Menu() {
    return (
        <div id="menu-page" className="flex flex-col top-0">
            <header id="sticky-header">
                <Header />
                <Category />
            </header>
            <div className="menu-content--categories-medium-photo menu-content pt-[160px] overflow-y-auto bg-[var(--ik-header-bg-color)]">

            </div>
        </div>
    );
}
