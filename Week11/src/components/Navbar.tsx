"use client";
import { useEffect, useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { FiMenu, FiX } from "react-icons/fi";
import { profile } from "@/data";

const navLinks = [
  { href: "#home", label: "Home" },
  { href: "#about", label: "About" },
  { href: "#projects", label: "Projects" },
  { href: "#experience", label: "Experience" },
  { href: "#certificates", label: "Certs" },
  { href: "#music", label: "Music" },
  { href: "#activities", label: "Activities" },
  { href: "#people", label: "People" },
  { href: "#contact", label: "Contact" },
];

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [active, setActive] = useState("#home");
  const [mobileOpen, setMobileOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 40);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => { entries.forEach((e) => { if (e.isIntersecting) setActive(`#${e.target.id}`); }); },
      { threshold: 0.4 }
    );
    navLinks.forEach(({ href }) => { const el = document.querySelector(href); if (el) observer.observe(el); });
    return () => observer.disconnect();
  }, []);

  const handleNav = (href: string) => {
    setActive(href); setMobileOpen(false);
    document.querySelector(href)?.scrollIntoView({ behavior: "smooth" });
  };

  return (
    <>
      <motion.nav
        initial={{ y: -80, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        transition={{ duration: 0.7, ease: "easeOut" }}
        className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
          scrolled ? "backdrop-blur-xl bg-white/80 border-b border-pink-200/80 shadow-md shadow-pink-100/20" : "bg-transparent"
        }`}
      >
        <div className="max-w-7xl mx-auto px-6 flex items-center justify-between h-16 lg:h-18">
          <motion.a href="#home" onClick={(e) => { e.preventDefault(); handleNav("#home"); }} className="flex items-center gap-2 group" whileHover={{ scale: 1.02 }}>
            <div className="w-8 h-8 rounded-full bg-gradient-to-br from-matcha-400 to-pink-500 flex items-center justify-center">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="white" />
              </svg>
            </div>
            <span className="font-display font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-matcha-600 text-lg">
              {profile.nickname}
            </span>
          </motion.a>

          <div className="hidden lg:flex items-center gap-1">
            {navLinks.map(({ href, label }) => (
              <button key={href} onClick={() => handleNav(href)}
                className={`relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 ${active === href ? "text-pink-950 font-black" : "text-pink-700/80 hover:text-pink-950"}`}>
                {active === href && (
                  <motion.div layoutId="nav-pill" className="absolute inset-0 rounded-full bg-gradient-to-r from-matcha-100/50 to-pink-50/50 border border-pink-250 shadow-sm" transition={{ type: "spring", stiffness: 350, damping: 30 }} />
                )}
                <span className="relative z-10">{label}</span>
              </button>
            ))}
          </div>

          <div className="hidden lg:flex items-center gap-3">
            <motion.a href={profile.cv} download className="btn-primary text-sm px-5 py-2" whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.97 }}>
              Download CV
            </motion.a>
          </div>

          <button className="lg:hidden text-pink-700 p-2" onClick={() => setMobileOpen(!mobileOpen)}>
            {mobileOpen ? <FiX size={24} /> : <FiMenu size={24} />}
          </button>
        </div>
      </motion.nav>

      <AnimatePresence>
        {mobileOpen && (
          <motion.div initial={{ opacity: 0, x: "100%" }} animate={{ opacity: 1, x: 0 }} exit={{ opacity: 0, x: "100%" }} transition={{ type: "spring", stiffness: 300, damping: 30 }}
            className="fixed top-0 right-0 h-full w-72 z-50 backdrop-blur-xl bg-white/95 border-l border-pink-200 flex flex-col pt-20 px-6 gap-2">
            <button className="absolute top-5 right-5 text-pink-750" onClick={() => setMobileOpen(false)}><FiX size={24} /></button>
            {navLinks.map(({ href, label }) => (
              <button key={href} onClick={() => handleNav(href)}
                className={`text-left px-4 py-3 rounded-xl text-sm font-bold transition-all duration-300 ${active === href ? "bg-gradient-to-r from-matcha-100/50 to-pink-50 border border-pink-200 text-pink-950 font-extrabold" : "text-pink-700/80 hover:text-pink-950 hover:bg-pink-50/50"}`}>
                {label}
              </button>
            ))}
            <div className="mt-4"><a href={profile.cv} download className="btn-primary text-sm text-center block">Download CV</a></div>
          </motion.div>
        )}
      </AnimatePresence>

      <AnimatePresence>
        {mobileOpen && (
          <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} onClick={() => setMobileOpen(false)} className="fixed inset-0 bg-black/15 z-40 lg:hidden" />
        )}
      </AnimatePresence>
    </>
  );
}
