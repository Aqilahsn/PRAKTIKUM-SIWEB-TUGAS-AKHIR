"use client";
import { motion } from "framer-motion";
import Image from "next/image";
import { FiMail, FiMapPin, FiBookOpen, FiMonitor } from "react-icons/fi";
import { profile, techStack } from "@/data";

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

const techIconMap: Record<string, React.ReactNode> = {
  react: <svg width="14" height="14" viewBox="0 0 24 24" fill="#61dafb"><circle cx="12" cy="12" r="3"/></svg>,
  nextjs: <svg width="14" height="14" viewBox="0 0 24 24" fill="#888"><polygon points="12,2 22,20 2,20"/></svg>,
  tailwind: <svg width="14" height="14" viewBox="0 0 24 24" fill="#38bdf8"><path d="M6 12C6 8 8 6 12 6C16 6 17 8 18 12C18 8 20 6 24 6" opacity="0.7"/><circle cx="12" cy="12" r="4"/></svg>,
  typescript: <svg width="14" height="14" viewBox="0 0 24 24" fill="#3178c6"><rect x="4" y="4" width="16" height="16" rx="2"/></svg>,
  laravel: <svg width="14" height="14" viewBox="0 0 24 24" fill="#f72c25"><circle cx="12" cy="12" r="5"/></svg>,
  mysql: <svg width="14" height="14" viewBox="0 0 24 24" fill="#00758f"><rect x="4" y="6" width="16" height="12" rx="2"/></svg>,
  framer: <svg width="14" height="14" viewBox="0 0 24 24" fill="#bb4af0"><circle cx="12" cy="12" r="6"/></svg>,
  figma: <svg width="14" height="14" viewBox="0 0 24 24" fill="#a259ff"><circle cx="12" cy="12" r="5"/></svg>,
};

const infoItems = [
  { label: "Email", value: profile.email, icon: FiMail },
  { label: "Location", value: profile.location, icon: FiMapPin },
  { label: "University", value: profile.university, icon: FiBookOpen },
  { label: "Major", value: profile.major, icon: FiMonitor },
];

export default function About() {
  return (
  <section id="about" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 0% 50%, rgba(132,204,22,0.08) 0%, transparent 50%), transparent" }}>
      <div className="orb w-[500px] h-[500px] -left-40 top-1/2 -translate-y-1/2 opacity-20" style={{ background: "radial-gradient(circle, rgba(132,204,22,0.3), transparent)" }} />

      <div className="max-w-7xl mx-auto">
        <motion.div {...fadeUp(0)} className="text-center mb-20">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">Get To Know Me</p>
          <h2 className="section-title">About Me</h2>
          <p className="section-subtitle">A little story about myself</p>
        </motion.div>

        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <motion.div {...fadeUp(0.1)} className="flex justify-center relative">
            <div className="relative">
              <div className="absolute -inset-3 rounded-3xl opacity-30" style={{ background: "linear-gradient(135deg, #84cc16, #f472b6, #84cc16)", filter: "blur(20px)" }} />
              <div className="relative w-72 h-80 md:w-[320px] md:h-[400px] rounded-3xl overflow-hidden border border-matcha-300 bg-white" style={{ boxShadow: "0 20px 40px rgba(132,204,22,0.12)" }}>
                <Image src="/profile.jpg" alt={profile.name} fill className="object-cover" style={{ objectPosition: "center 65%" }} />
                <div className="absolute inset-0 bg-gradient-to-t from-pink-950/20 via-transparent to-transparent" />
                <div className="absolute bottom-4 left-4">
                  <p className="text-white font-semibold text-sm drop-shadow-md">{profile.name}</p>
                  <p className="text-white/80 text-xs font-semibold drop-shadow-md">{profile.title}</p>
                </div>
              </div>

              <motion.div animate={{ y: [-5, 5, -5] }} transition={{ duration: 4, repeat: Infinity }} className="absolute -top-6 -right-6 glass-card px-4 py-3 rounded-2xl border border-matcha-300 bg-white/95">
                <div className="flex items-center gap-2 mb-1">
                  <FiBookOpen size={12} className="text-matcha-600" />
                  <p className="text-matcha-700 text-xs font-bold">University</p>
                </div>
                <p className="text-pink-950 text-xs font-semibold">{profile.university}</p>
                <p className="text-pink-700 text-xs font-medium">{profile.major}</p>
              </motion.div>

              <motion.div animate={{ y: [5, -5, 5] }} transition={{ duration: 3, repeat: Infinity, delay: 1 }} className="absolute -bottom-6 -left-6 glass-card px-4 py-3 rounded-2xl border border-matcha-300 bg-white/95">
                <div className="flex items-center gap-2">
                  <FiMapPin size={12} className="text-matcha-600" />
                  <p className="text-pink-950 text-xs font-bold">{profile.location}</p>
                </div>
              </motion.div>
            </div>
          </motion.div>

          <div className="flex flex-col gap-8">
            <motion.div {...fadeUp(0.2)}>
              <h3 className="font-display text-3xl font-bold text-pink-950 mb-4">
                Passionate <span className="text-gradient">Frontend Developer</span>
              </h3>
              <p className="text-pink-900/80 leading-relaxed mb-4 font-medium">{profile.bio}</p>
              <p className="text-pink-900/70 leading-relaxed font-medium">{profile.bioExtra}</p>
            </motion.div>

            <motion.div {...fadeUp(0.3)} className="grid grid-cols-4 gap-4">
              {profile.stats.map((s) => (
                <div key={s.label} className="glass-card p-4 rounded-2xl text-center border border-pink-200 bg-white/80">
                  <p className="font-display font-bold text-2xl text-gradient">{s.value}</p>
                  <p className="text-pink-700 text-xs mt-1 font-semibold">{s.label}</p>
                </div>
              ))}
            </motion.div>

            <motion.div {...fadeUp(0.4)}>
              <p className="text-matcha-700/80 text-sm font-semibold mb-4 uppercase tracking-widest">Tech Stack</p>
              <div className="flex flex-wrap gap-3">
                {techStack.map((tech, i) => (
                  <motion.div key={tech.name} initial={{ opacity: 0, scale: 0.8 }} whileInView={{ opacity: 1, scale: 1 }} viewport={{ once: true }} transition={{ delay: 0.4 + i * 0.05 }} whileHover={{ scale: 1.1, y: -2 }} className="flex items-center gap-2 px-4 py-2 rounded-full glass-card border border-pink-300 bg-white/80 cursor-default">
                    {techIconMap[tech.iconKey] || <div className="w-3 h-3 rounded-full" style={{ background: tech.color }} />}
                    <span className="text-pink-900 text-sm font-semibold">{tech.name}</span>
                    <div className="w-1.5 h-1.5 rounded-full" style={{ background: tech.color }} />
                  </motion.div>
                ))}
              </div>
            </motion.div>

            <motion.div {...fadeUp(0.5)} className="grid grid-cols-2 gap-3">
              {infoItems.map((item) => (
                <div key={item.label} className="flex items-start gap-3 p-3 rounded-xl glass-card-light bg-white/50 border border-pink-200">
                  <item.icon size={16} className="text-matcha-600 mt-0.5 flex-shrink-0" />
                  <div>
                    <p className="text-pink-700/60 text-xs font-semibold">{item.label}</p>
                    <p className="text-pink-950 text-sm font-bold truncate">{item.value}</p>
                  </div>
                </div>
              ))}
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
}
