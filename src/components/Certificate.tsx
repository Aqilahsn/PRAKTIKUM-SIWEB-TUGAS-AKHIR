"use client";
import { motion } from "framer-motion";
import { FiExternalLink, FiAward } from "react-icons/fi";
import { certificates } from "@/data";

const catColors: Record<string, string> = {
  Frontend: "from-matcha-400 to-pink-500",
  Design: "from-purple-400 to-pink-500",
  "Full Stack": "from-pink-500 to-matcha-500",
  Backend: "from-red-400 to-matcha-500",
  Programming: "from-amber-400 to-matcha-500",
};

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

export default function Certificate() {
  return (
  <section id="certificates" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 80% 100%, rgba(132,204,22,0.08) 0%, transparent 50%), transparent" }}>
      <div className="max-w-7xl mx-auto">
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">My Achievements</p>
          <h2 className="section-title">Certificates</h2>
          <p className="section-subtitle font-medium text-pink-800/80">Proof of my learning journey</p>
        </motion.div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {certificates.map((cert, i) => (
            <motion.div key={cert.id} initial={{ opacity: 0, y: 30, scale: 0.95 }} whileInView={{ opacity: 1, y: 0, scale: 1 }} viewport={{ once: true }} transition={{ delay: i * 0.08, duration: 0.6 }} whileHover={{ y: -6, boxShadow: "0 20px 40px rgba(132,204,22,0.08)" }} className="glass-card rounded-2xl overflow-hidden border border-pink-200 bg-white/90 group cursor-default">
              <div className={`relative h-24 bg-gradient-to-br ${catColors[cert.category] ?? "from-matcha-500 to-pink-500"} flex items-center justify-center`}>
                <FiAward size={40} className="text-white/20" />
                <div className="absolute inset-0 bg-gradient-to-t from-pink-950/20 to-transparent" />
                <div className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500" style={{ background: `radial-gradient(ellipse at center, ${cert.color}20, transparent)` }} />
                <div className="absolute top-3 right-3 p-2 rounded-full bg-white/20 backdrop-blur-sm"><FiAward className="text-white" size={14} /></div>
              </div>

              <div className="p-5">
                <div className="flex items-start justify-between gap-2 mb-2">
                  <div>
                    <h3 className="font-display font-bold text-pink-950 text-base leading-tight group-hover:text-gradient transition-all duration-300">{cert.title}</h3>
                    <p className="text-pink-700/80 text-sm mt-1 font-semibold">{cert.issuer}</p>
                  </div>
                  <div className="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style={{ background: `${cert.color}15`, border: `1px solid ${cert.color}30` }}>
                    <div className="w-3 h-3 rounded-full" style={{ background: cert.color }} />
                  </div>
                </div>

                <div className="flex items-center gap-2 mb-4">
                  <span className="tag-badge bg-pink-50 text-pink-700 border border-pink-200 font-semibold">{cert.category}</span>
                  <span className="text-pink-600/70 text-xs font-semibold">{cert.date}</span>
                </div>

                <p className="text-pink-600/50 text-xs mb-4 font-mono font-semibold">ID: {cert.credentialId}</p>

                <motion.a href={cert.verifyUrl} target="_blank" rel="noopener noreferrer" whileHover={{ scale: 1.03 }} whileTap={{ scale: 0.97 }} className="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl border border-matcha-300 text-matcha-700 text-sm font-semibold transition-all duration-300 hover:bg-matcha-50 hover:border-matcha-400 bg-white">
                  <FiExternalLink size={14} /> Verify Certificate
                </motion.a>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
