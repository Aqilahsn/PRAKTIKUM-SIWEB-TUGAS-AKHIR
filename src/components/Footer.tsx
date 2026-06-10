"use client";
import { motion } from "framer-motion";
import { FiInstagram, FiGithub, FiLinkedin, FiMessageCircle, FiHeart, FiMail, FiMapPin } from "react-icons/fi";
import { profile } from "@/data";

const navLinks = [
  { href: "#home", label: "Home" },
  { href: "#about", label: "About" },
  { href: "#projects", label: "Projects" },
  { href: "#experience", label: "Experience" },
  { href: "#certificates", label: "Certificates" },
  { href: "#music", label: "Music" },
  { href: "#contact", label: "Contact" },
];

const socials = [
  { icon: FiInstagram, href: profile.instagram, label: "Instagram", color: "#e1306c" },
  { icon: FiGithub, href: profile.github, label: "GitHub", color: "#181717" },
  { icon: FiLinkedin, href: profile.linkedin, label: "LinkedIn", color: "#0a66c2" },
  { icon: FiMessageCircle, href: profile.whatsapp, label: "WhatsApp", color: "#25d366" },
];

export default function Footer() {
  const year = new Date().getFullYear();

  return (
  <footer className="relative pt-20 pb-8 px-6 overflow-hidden border-t border-pink-200 site-footer">
      <div className="max-w-7xl mx-auto relative z-10">
        <div className="grid md:grid-cols-3 gap-12 mb-12">
          <div>
            <div className="flex items-center gap-2 mb-4">
              <div className="w-8 h-8 rounded-full bg-gradient-to-br from-matcha-400 to-pink-500 flex items-center justify-center">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
              </div>
              <span className="font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-matcha-600 to-pink-600 text-xl">{profile.nickname}</span>
            </div>
            <p className="text-pink-900/60 text-sm leading-relaxed mb-4 font-semibold">{profile.tagline}</p>
            <div className="flex gap-3">
              {socials.map((s) => (
                <motion.a key={s.label} href={s.href} target="_blank" rel="noopener noreferrer" whileHover={{ scale: 1.2, y: -2 }} whileTap={{ scale: 0.9 }} className="w-9 h-9 rounded-full glass-card border border-pink-200 flex items-center justify-center text-pink-700/80 hover:text-pink-950 transition-colors bg-white/80" title={s.label}>
                  <s.icon size={15} style={{ color: s.color }} />
                </motion.a>
              ))}
            </div>
          </div>

          <div>
            <p className="text-matcha-700 text-sm font-bold uppercase tracking-widest mb-4">Navigation</p>
            <div className="grid grid-cols-2 gap-2">
              {navLinks.map(({ href, label }) => (
                <button key={href} onClick={() => document.querySelector(href)?.scrollIntoView({ behavior: "smooth" })} className="text-pink-800/70 text-sm font-semibold hover:text-pink-950 transition-colors text-left">{label}</button>
              ))}
            </div>
          </div>

          <div>
            <p className="text-matcha-700 text-sm font-bold uppercase tracking-widest mb-4">Say Hello</p>
            <div className="flex flex-col gap-2">
              <a href={`mailto:${profile.email}`} className="flex items-center gap-2 text-pink-800/70 text-sm font-semibold hover:text-pink-950 transition-colors">
                <FiMail size={14} className="text-matcha-600" /> {profile.email}
              </a>
              <a href={profile.whatsapp} target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 text-pink-800/70 text-sm font-semibold hover:text-pink-950 transition-colors">
                <FiMessageCircle size={14} className="text-matcha-600" /> WhatsApp
              </a>
              <p className="flex items-center gap-2 text-pink-800/70 text-sm font-semibold">
                <FiMapPin size={14} className="text-matcha-600" /> {profile.location}
              </p>
              <div className="mt-4 px-4 py-2 rounded-full border border-matcha-200 bg-matcha-50 inline-flex items-center gap-2 w-fit">
                <span className="w-2 h-2 rounded-full bg-matcha-500 animate-pulse" />
                <span className="text-matcha-700 text-xs font-semibold">Available for work</span>
              </div>
            </div>
          </div>
        </div>

        <div className="h-px w-full mb-6" style={{ background: "linear-gradient(90deg, transparent, rgba(132,204,22,0.2), transparent)" }} />

        <div className="flex flex-col md:flex-row items-center justify-between gap-4">
          <p className="text-pink-800/60 text-sm flex items-center gap-1.5 font-semibold">
            &copy; {year} {profile.name} · Made with <FiHeart className="text-pink-500 animate-pulse fill-pink-500" size={14} /> using Next.js
          </p>
          <p className="text-pink-800/40 text-xs font-semibold">
            Designed &amp; Developed by {profile.nickname}
          </p>
        </div>
      </div>
    </footer>
  );
}
