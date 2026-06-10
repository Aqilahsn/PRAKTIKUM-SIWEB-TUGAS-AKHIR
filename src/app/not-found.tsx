"use client";
import { motion } from "framer-motion";
import Link from "next/link";
import { useEffect, useState } from "react";

const PETALS = ["🌸", "🌺", "✿", "❀", "🌹"];

interface Petal {
  id: number;
  emoji: string;
  left: number;
  delay: number;
  duration: number;
  size: number;
}

export default function NotFound() {
  const [petals, setPetals] = useState<Petal[]>([]);

  useEffect(() => {
    setPetals(
      Array.from({ length: 15 }, (_, i) => ({
        id: i,
        emoji: PETALS[i % PETALS.length],
        left: Math.random() * 100,
        delay: Math.random() * 5,
        duration: 6 + Math.random() * 8,
        size: 0.8 + Math.random() * 0.8,
      }))
    );
  }, []);

  return (
    <div
      className="min-h-screen flex items-center justify-center relative overflow-hidden"
      style={{
        background:
          "radial-gradient(ellipse at 30% 40%, rgba(244,114,182,0.15) 0%, transparent 60%), radial-gradient(ellipse at 70% 60%, rgba(128,0,32,0.05) 0%, transparent 60%), #fff6f9",
      }}
    >
      {/* Petals */}
      {petals.map((p) => (
        <span
          key={p.id}
          className="absolute pointer-events-none select-none"
          style={{
            left: `${p.left}%`,
            top: "-5%",
            fontSize: `${p.size}rem`,
            animationName: "petal",
            animationDuration: `${p.duration}s`,
            animationDelay: `${p.delay}s`,
            animationTimingFunction: "linear",
            animationIterationCount: "infinite",
            opacity: 0.5,
            filter: "drop-shadow(0 0 6px rgba(244,114,182,0.3))",
          }}
        >
          {p.emoji}
        </span>
      ))}

      {/* Orbs */}
      <motion.div
        animate={{ scale: [1, 1.3, 1], opacity: [0.2, 0.4, 0.2] }}
        transition={{ duration: 6, repeat: Infinity }}
        className="absolute w-96 h-96 rounded-full blur-3xl"
        style={{
          background: "radial-gradient(circle, #fbcfe8, transparent)",
          top: "10%", left: "-10%",
        }}
      />
      <motion.div
        animate={{ scale: [1.2, 1, 1.2], opacity: [0.15, 0.3, 0.15] }}
        transition={{ duration: 8, repeat: Infinity, delay: 2 }}
        className="absolute w-80 h-80 rounded-full blur-3xl"
        style={{
          background: "radial-gradient(circle, #f472b6, transparent)",
          bottom: "10%", right: "-10%",
        }}
      />

      {/* Content */}
      <div className="relative z-10 text-center px-6">
        {/* 404 number */}
        <motion.div
          initial={{ opacity: 0, scale: 0.5 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.8, ease: [0.22, 1, 0.36, 1] }}
          className="mb-6"
        >
          <span
            className="font-display font-black text-transparent bg-clip-text select-none"
            style={{
              fontSize: "clamp(6rem, 20vw, 14rem)",
              backgroundImage: "linear-gradient(135deg, #db2777, #be185d, #800020)",
              filter: "drop-shadow(0 10px 40px rgba(219,39,119,0.15))",
              lineHeight: 1,
            }}
          >
            404
          </span>
        </motion.div>

        {/* Emoji */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.3, duration: 0.6 }}
          className="mb-4"
        >
          <motion.span
            animate={{ rotate: [0, -10, 10, 0], y: [0, -8, 0] }}
            transition={{ duration: 3, repeat: Infinity, ease: "easeInOut" }}
            className="text-6xl inline-block"
          >
            🌸
          </motion.span>
        </motion.div>

        {/* Text */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.4, duration: 0.6 }}
          className="mb-3"
        >
          <h1 className="font-display font-bold text-pink-950 text-3xl md:text-4xl">
            Oops! Page Not Found
          </h1>
        </motion.div>

        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.5 }}
          className="text-pink-900/80 text-lg mb-10 max-w-md mx-auto leading-relaxed font-semibold"
        >
          This page seems to have floated away with the sakura petals.
          Let's get you back home!
        </motion.p>

        {/* CTA Buttons */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.6 }}
          className="flex flex-col sm:flex-row items-center justify-center gap-4"
        >
          <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.97 }}>
            <Link
              href="/"
              className="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold text-white transition-all duration-300"
              style={{
                background: "linear-gradient(135deg, #db2777, #800020)",
                boxShadow: "0 4px 20px rgba(219,39,119,0.3)",
              }}
            >
              Back to Home
            </Link>
          </motion.div>

          <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.97 }}>
            <Link
              href="/#projects"
              className="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold text-pink-700 border border-pink-300 hover:border-pink-400 hover:bg-pink-100/30 transition-all duration-300 bg-white"
            >
              View Projects
            </Link>
          </motion.div>
        </motion.div>

        {/* Decorative floating chips */}
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.8 }}
          className="flex items-center justify-center gap-3 mt-12 flex-wrap"
        >
          {["Home", "About", "Projects", "Contact"].map((item, i) => (
            <motion.div
              key={item}
              animate={{ y: [0, -4, 0] }}
              transition={{ duration: 2 + i * 0.3, repeat: Infinity, delay: i * 0.2 }}
            >
              <Link
                href={`/#${item.toLowerCase()}`}
                className="px-4 py-1.5 rounded-full text-xs text-pink-700 hover:text-pink-950 border border-pink-200 hover:border-pink-300 transition-all duration-300 backdrop-blur-sm bg-white/40 font-bold"
              >
                {item}
              </Link>
            </motion.div>
          ))}
        </motion.div>
      </div>
    </div>
  );
}
