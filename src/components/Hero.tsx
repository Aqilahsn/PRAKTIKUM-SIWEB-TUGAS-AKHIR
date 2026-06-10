"use client";
import { motion } from "framer-motion";
import Image from "next/image";
import { FiArrowDown } from "react-icons/fi";
import { profile } from "@/data";
import Typewriter from "@/components/Typewriter";

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 40 },
  animate: { opacity: 1, y: 0 },
  transition: { duration: 0.8, delay, ease: [0.22, 1, 0.36, 1] as const },
});

export default function Hero() {
  return (
    <section
      id="home"
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
      style={{
        background:
          "radial-gradient(ellipse at 20% 50%, rgba(132,204,22,0.12) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(253,242,248,0.6) 0%, transparent 60%), radial-gradient(ellipse at 50% 80%, rgba(132,204,22,0.06) 0%, transparent 60%), transparent",
      }}
    >
      <motion.div animate={{ scale: [1, 1.2, 1], opacity: [0.15, 0.25, 0.15] }} transition={{ duration: 6, repeat: Infinity, ease: "easeInOut" }} className="orb w-96 h-96 top-[-80px] left-[-80px] opacity-20" style={{ background: "radial-gradient(circle, #84cc16 0%, transparent 70%)" }} />
      <motion.div animate={{ scale: [1.2, 1, 1.2], opacity: [0.1, 0.2, 0.1] }} transition={{ duration: 8, repeat: Infinity, ease: "easeInOut", delay: 2 }} className="orb w-80 h-80 bottom-[-60px] right-[-60px] opacity-15" style={{ background: "radial-gradient(circle, #f472b6 0%, transparent 70%)" }} />
      <motion.div animate={{ scale: [1, 1.3, 1], opacity: [0.08, 0.18, 0.08] }} transition={{ duration: 10, repeat: Infinity, ease: "easeInOut", delay: 4 }} className="orb w-64 h-64 top-1/2 left-1/3 opacity-10" style={{ background: "radial-gradient(circle, #84cc16 0%, transparent 70%)" }} />

      <div className="relative z-10 max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center pt-20">
        <div className="flex flex-col gap-6">
          <motion.div {...fadeUp(0.1)} className="flex items-center gap-3">
            <div className="flex items-center gap-2 px-4 py-2 rounded-full glass-card border border-matcha-300/40 bg-white/70">
              <span className="w-2 h-2 rounded-full bg-matcha-500 animate-pulse" />
              <span className="text-matcha-700 text-sm font-medium">Available for freelance</span>
            </div>
          </motion.div>

          <motion.div {...fadeUp(0.2)}>
            <p className="text-matcha-600/80 text-lg font-semibold mb-2 tracking-widest uppercase">Hello, I&apos;m</p>
            <h1 className="font-display font-black leading-tight text-pink-950" style={{ fontSize: "clamp(2.4rem, 5vw, 4.2rem)" }}>
              <span className="text-gradient">{profile.name}</span>
            </h1>
          </motion.div>

          <motion.div {...fadeUp(0.3)}>
            <div className="flex items-center gap-3 flex-wrap">
              <div className="px-6 py-2.5 rounded-full text-white font-semibold text-xl min-w-[240px]" style={{ background: "linear-gradient(135deg, #84cc16, #f472b6)", boxShadow: "0 4px 20px rgba(132,204,22,0.25)" }}>
                <Typewriter words={["Frontend Developer", "UI Designer", "React Developer", "Web Creator"]} speed={90} deleteSpeed={50} pauseTime={2200} />
              </div>
            </div>
          </motion.div>

          <motion.p {...fadeUp(0.4)} className="text-pink-900/70 text-lg leading-relaxed max-w-lg font-medium">{profile.tagline}</motion.p>

          <motion.div {...fadeUp(0.5)} className="flex items-center gap-4 flex-wrap">
            <motion.button whileHover={{ scale: 1.05, boxShadow: "0 0 30px rgba(132,204,22,0.4)" }} whileTap={{ scale: 0.97 }} onClick={() => document.querySelector("#projects")?.scrollIntoView({ behavior: "smooth" })} className="btn-primary px-8 py-3.5 text-base">
              View Projects
            </motion.button>
            <motion.button whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.97 }} onClick={() => document.querySelector("#contact")?.scrollIntoView({ behavior: "smooth" })} className="btn-outline px-8 py-3.5 text-base border-pink-300">
              Contact Me
            </motion.button>
          </motion.div>

          <motion.div {...fadeUp(0.6)} className="grid grid-cols-4 gap-4 mt-4">
            {profile.stats.map((s) => (
              <div key={s.label} className="text-center">
                <p className="font-display font-bold text-2xl text-gradient">{s.value}</p>
                <p className="text-pink-800/60 text-xs mt-1 font-semibold">{s.label}</p>
              </div>
            ))}
          </motion.div>
        </div>

        {/* Right — Swinging Nametag */}
        <motion.div initial={{ opacity: 0, y: -40 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 1, delay: 0.3, ease: [0.22, 1, 0.36, 1] }} className="flex flex-col items-center relative">
          <div className="flex flex-col items-center">
            <div className="w-3 h-3 rounded-full border-2 border-matcha-400 bg-gradient-to-br from-matcha-200 to-matcha-400" style={{ boxShadow: "0 0 8px rgba(132,204,22,0.4)" }} />
            <div className="w-5 lanyard-pattern" style={{ height: "60px", borderRadius: "0 0 2px 2px", boxShadow: "0 2px 8px rgba(132,204,22,0.15)" }} />
          </div>

          <div className="nametag-swing">
            <div className="flex justify-center">
              <div className="relative w-14 h-7 rounded-t-lg" style={{ background: "linear-gradient(180deg, #d4e8a0 0%, #a3c55e 50%, #84cc16 100%)", boxShadow: "0 2px 6px rgba(132,204,22,0.2), inset 0 1px 0 rgba(255,255,255,0.6)" }}>
                <div className="absolute top-1 left-1/2 -translate-x-1/2 w-8 h-3 rounded-t-md" style={{ background: "linear-gradient(180deg, #e0f0b5, #c0dd7a)", boxShadow: "inset 0 1px 2px rgba(132,204,22,0.1)" }} />
              </div>
            </div>

            <div className="relative w-64 md:w-[300px] rounded-2xl overflow-hidden" style={{ background: "linear-gradient(180deg, #fff8fa, #fff0f5)", border: "2px solid rgba(132,204,22,0.25)", boxShadow: "0 20px 50px rgba(132,204,22,0.12), 0 8px 20px rgba(244,114,182,0.1), inset 0 1px 0 rgba(255,255,255,0.9)" }}>
              <div className="flex justify-center pt-4 pb-2">
                <div className="w-5 h-5 rounded-full" style={{ background: "linear-gradient(135deg, #e0f0c0, #c8e090)", border: "2px solid rgba(132,204,22,0.2)", boxShadow: "inset 0 2px 4px rgba(132,204,22,0.15), 0 1px 2px rgba(255,255,255,0.5)" }} />
              </div>

              <div className="mx-6 mb-3">
                <div className="h-0.5 rounded-full" style={{ background: "linear-gradient(90deg, transparent, #84cc16, #f472b6, #84cc16, transparent)", opacity: 0.4 }} />
              </div>

              <div className="px-5 pb-3">
                <div className="relative w-full rounded-xl overflow-hidden" style={{ aspectRatio: "3/4", border: "2px solid rgba(132,204,22,0.2)", boxShadow: "0 4px 12px rgba(132,204,22,0.08)" }}>
                  <Image src="/profile.jpg" alt={profile.name} fill className="object-cover" style={{ objectPosition: "center 65%" }} priority />
                  <div className="absolute inset-0 bg-gradient-to-t from-pink-950/15 via-transparent to-white/5" />
                </div>
              </div>

              <div className="px-5 pb-5 text-center">
                <div className="flex items-center justify-center gap-1 mb-1">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="#84cc16"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="#f472b6"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="#84cc16"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
                </div>

                <h3 className="font-display font-bold text-lg md:text-xl mb-1" style={{ background: "linear-gradient(135deg, #84cc16, #f472b6)", WebkitBackgroundClip: "text", WebkitTextFillColor: "transparent" }}>
                  {profile.name}
                </h3>
                <p className="text-pink-700 text-sm font-semibold mb-2">{profile.title}</p>

                <div className="flex items-center justify-center gap-2 mb-2">
                  <div className="w-8 h-px bg-matcha-300/60" />
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="#84cc16"><circle cx="12" cy="12" r="5" /></svg>
                  <div className="w-8 h-px bg-matcha-300/60" />
                </div>

                <p className="text-pink-800/60 text-xs font-medium">{profile.university}</p>
                <p className="text-pink-600/50 text-xs font-medium">{profile.major}</p>

                <div className="mt-3 mx-auto inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full" style={{ background: "linear-gradient(135deg, rgba(132,204,22,0.1), rgba(244,114,182,0.08))", border: "1px solid rgba(132,204,22,0.2)" }}>
                  <span className="w-1.5 h-1.5 rounded-full bg-matcha-500 animate-pulse" />
                  <span className="text-matcha-700 text-xs font-semibold">Open to Work</span>
                </div>
              </div>

              <div className="h-2" style={{ background: "linear-gradient(90deg, #84cc16, #f472b6, #84cc16)" }} />
            </div>
          </div>

          <motion.div animate={{ y: [-5, 5, -5], opacity: [0.4, 0.8, 0.4] }} transition={{ duration: 3, repeat: Infinity }} className="absolute top-20 -right-6">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#84cc16"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
          </motion.div>
          <motion.div animate={{ y: [4, -4, 4], opacity: [0.3, 0.7, 0.3] }} transition={{ duration: 4, repeat: Infinity, delay: 1 }} className="absolute bottom-24 -left-6">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f472b6"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
          </motion.div>
          <motion.div animate={{ scale: [0.8, 1.2, 0.8], opacity: [0.3, 0.6, 0.3] }} transition={{ duration: 5, repeat: Infinity, delay: 0.5 }} className="absolute top-1/3 -left-8">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="#84cc16"><circle cx="12" cy="12" r="8" /></svg>
          </motion.div>
        </motion.div>
      </div>

      <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 1.5, duration: 0.6 }} className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
        <p className="text-matcha-600/60 text-xs tracking-widest uppercase font-semibold">Scroll</p>
        <motion.div animate={{ y: [0, 8, 0] }} transition={{ duration: 1.5, repeat: Infinity }}>
          <FiArrowDown className="text-matcha-500/80" size={20} />
        </motion.div>
      </motion.div>
    </section>
  );
}
