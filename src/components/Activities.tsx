"use client";
import { motion } from "framer-motion";
import { FiCode, FiFilm, FiCrosshair, FiNavigation, FiHeadphones, FiCoffee } from "react-icons/fi";
import { activities } from "@/data";

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

const iconMap: Record<string, React.ReactNode> = {
  code: <FiCode size={22} className="text-matcha-600" />,
  movie: <FiFilm size={22} className="text-pink-600" />,
  gamepad: <FiCrosshair size={22} className="text-matcha-600" />,
  plane: <FiNavigation size={22} className="text-pink-600" />,
  music: <FiHeadphones size={22} className="text-matcha-600" />,
  coffee: <FiCoffee size={22} className="text-pink-600" />,
};

export default function Activities() {
  return (
  <section id="activities" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 0% 100%, rgba(132,204,22,0.08) 0%, transparent 50%), transparent" }}>
      <div className="max-w-7xl mx-auto">
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">Beyond Code</p>
          <h2 className="section-title">Favorite Activities</h2>
          <p className="section-subtitle font-medium text-pink-800/80">Things that make me happy outside of work</p>
        </motion.div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {activities.map((act, i) => (
            <motion.div key={act.id} initial={{ opacity: 0, y: 30, scale: 0.95 }} whileInView={{ opacity: 1, y: 0, scale: 1 }} viewport={{ once: true }} transition={{ delay: i * 0.1, duration: 0.6 }} whileHover={{ y: -8, scale: 1.02 }}
              className="relative p-6 rounded-3xl border border-pink-200 overflow-hidden cursor-default group bg-white/80" style={{ backdropFilter: "blur(12px)", boxShadow: "0 10px 30px rgba(132,204,22,0.04)" }}>
              <div className="absolute inset-0 bg-gradient-to-br from-matcha-50/40 to-pink-50/20 rounded-3xl" />
              <motion.div className="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500" style={{ background: "radial-gradient(ellipse at 50% 50%, rgba(132,204,22,0.12), transparent)" }} />
              <div className="relative z-10">
                <motion.div whileHover={{ scale: 1.05 }} transition={{ duration: 0.3 }} className="mb-4 inline-flex w-12 h-12 rounded-lg items-center justify-center bg-white/60 border border-matcha-200">
                  {iconMap[act.iconKey] || <FiCode size={22} className="text-matcha-600" />}
                </motion.div>
                <h3 className="font-display font-bold text-pink-950 text-xl mb-2">{act.title}</h3>
                <p className="text-pink-900/70 text-sm leading-relaxed mb-4 font-medium">{act.description}</p>
                <div className="flex flex-wrap gap-2">
                  {act.tags.map((tag) => (<span key={tag} className="tag-badge bg-matcha-50 text-matcha-700 border border-matcha-200">{tag}</span>))}
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
