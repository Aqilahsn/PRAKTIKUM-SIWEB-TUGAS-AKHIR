"use client";
import { motion } from "framer-motion";
import { FiUsers, FiLink, FiAward } from "react-icons/fi";
import { experiences } from "@/data";

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

const iconMap: Record<string, React.ReactNode> = {
  users: <FiUsers size={20} />,
  handshake: <FiLink size={20} />,
  award: <FiAward size={20} />,
};

export default function Experience() {
  return (
    <section
      id="experience"
      className="relative py-28 px-6 overflow-hidden"
      style={{
        background:
          "radial-gradient(ellipse at 30% 50%, rgba(132,204,22,0.08) 0%, transparent 60%), radial-gradient(ellipse at 70% 50%, rgba(244,114,182,0.08) 0%, transparent 60%), #fff6f9",
      }}
    >
      <div className="max-w-5xl mx-auto">
        {/* Header */}
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">
            My Journey
          </p>
          <h2 className="section-title">Experience</h2>
          <p className="section-subtitle font-medium text-pink-800/80">
            Every step that shaped who I am
          </p>
        </motion.div>

        {/* Timeline */}
        <div className="relative">
          {/* Vertical line */}
          <div
            className="absolute left-8 top-0 bottom-0 w-0.5 hidden md:block"
            style={{
              background:
                "linear-gradient(180deg, #84cc16, #f472b6, #f59e0b)",
            }}
          />

          <div className="flex flex-col gap-8">
            {experiences.map((exp, i) => (
              <motion.div
                key={exp.id}
                initial={{ opacity: 0, x: -30 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.15, duration: 0.6 }}
                className="relative md:pl-20"
              >
                {/* Timeline dot */}
                <div
                  className="absolute left-5 top-6 w-7 h-7 rounded-full border-2 border-white flex items-center justify-center z-10 hidden md:flex"
                  style={{
                    background: exp.color,
                    boxShadow: `0 0 16px ${exp.color}44`,
                  }}
                >
                  <div className="w-2 h-2 rounded-full bg-white" />
                </div>

                {/* Card */}
                <motion.article
                  whileHover={{ y: -4, boxShadow: "0 16px 40px rgba(132,204,22,0.08)" }}
                  className="relative p-6 rounded-2xl border border-pink-200 bg-white/90 backdrop-blur-sm overflow-hidden group"
                  style={{
                    boxShadow: "0 8px 24px rgba(183,110,121,0.06)",
                  }}
                >
                  {/* Accent top bar */}
                  <div
                    className="absolute top-0 left-0 right-0 h-1 rounded-t-2xl"
                    style={{
                      background: `linear-gradient(90deg, ${exp.color}, ${exp.color}66)`,
                    }}
                  />

                  {/* Header row */}
                  <div className="flex items-start justify-between gap-4 mb-3">
                    <div className="flex items-center gap-3">
                      {/* Icon */}
                      <div
                        className="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                        style={{
                          background: `${exp.color}15`,
                          color: exp.color,
                          border: `1px solid ${exp.color}30`,
                        }}
                      >
                        {iconMap[exp.iconKey] || <FiAward size={20} />}
                      </div>
                      <div>
                        <span
                          className="text-xs font-bold tracking-wider uppercase"
                          style={{ color: exp.color }}
                        >
                          {exp.period}
                        </span>
                        <h3 className="font-display font-bold text-pink-950 text-lg leading-tight">
                          {exp.title}
                        </h3>
                      </div>
                    </div>
                    <span
                      className="text-sm font-bold flex-shrink-0 px-3 py-1 rounded-full"
                      style={{
                        color: exp.color,
                        background: `${exp.color}10`,
                        border: `1px solid ${exp.color}25`,
                      }}
                    >
                      {exp.company}
                    </span>
                  </div>

                  {/* Location */}
                  <p className="text-pink-700/60 text-sm font-medium mb-2 ml-13">
                    {exp.location}
                  </p>

                  {/* Description */}
                  <p className="text-pink-900/80 text-sm leading-relaxed mb-4 font-medium">
                    {exp.description}
                  </p>

                  {/* Skills */}
                  <div className="flex flex-wrap gap-2">
                    {exp.skills?.map((s) => (
                      <span
                        key={s}
                        className="px-3 py-1 text-xs font-semibold rounded-full"
                        style={{
                          background: `${exp.color}10`,
                          color: exp.color,
                          border: `1px solid ${exp.color}20`,
                        }}
                      >
                        {s}
                      </span>
                    ))}
                  </div>
                </motion.article>
              </motion.div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
