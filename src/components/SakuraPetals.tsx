"use client";
import { useEffect, useState } from "react";
import { motion, AnimatePresence } from "framer-motion";

const PETALS = ["🌸", "🌺", "✿", "❀", "🌹", "✾"];

interface Petal {
  id: number;
  emoji: string;
  left: number;
  delay: number;
  duration: number;
  size: number;
}

export default function SakuraPetals() {
  const [petals, setPetals] = useState<Petal[]>([]);

  useEffect(() => {
    const generate = (): Petal[] =>
      Array.from({ length: 18 }, (_, i) => ({
        id: i,
        emoji: PETALS[i % PETALS.length],
        left: Math.random() * 100,
        delay: Math.random() * 10,
        duration: 8 + Math.random() * 10,
        size: 0.8 + Math.random() * 0.8,
      }));
    setPetals(generate());
  }, []);

  return (
    <div className="fixed inset-0 pointer-events-none z-0 overflow-hidden">
      {petals.map((p) => (
        <span
          key={p.id}
          className="absolute select-none"
          style={{
            left: `${p.left}%`,
            top: "-5%",
            fontSize: `${p.size}rem`,
            animationName: "petal",
            animationDuration: `${p.duration}s`,
            animationDelay: `${p.delay}s`,
            animationTimingFunction: "linear",
            animationIterationCount: "infinite",
            opacity: 0.6,
            filter: "drop-shadow(0 0 4px rgba(244,114,182,0.5))",
          }}
        >
          {p.emoji}
        </span>
      ))}
    </div>
  );
}
