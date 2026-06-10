"use client";
import { motion } from "framer-motion";
import Image from "next/image";
import { people } from "@/data";
import { useEffect, useState } from "react";

const typeLabels: Record<string, string> = {
  partner: "Partner",
  family: "Family",
  bestfriend: "Best Friend",
  cat: "Pet",
};

const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

export default function People() {
  const [editMode, setEditMode] = useState(false);
  const [offsets, setOffsets] = useState<Record<number, number>>({});

  useEffect(() => {
    if (typeof window === "undefined") return;
    const params = new URLSearchParams(window.location.search);
    setEditMode(params.get("edit") === "1");
    // initialize offsets from data
    const initial: Record<number, number> = {};
    people.forEach((p) => {
      initial[p.id] = typeof p.imageOffset === "number" ? p.imageOffset : 0;
    });
    setOffsets(initial);
  }, []);

  const updateOffset = (id: number, val: number) => {
    setOffsets((s) => ({ ...s, [id]: val }));
  };

  const copyPatch = async () => {
    // create a snippet showing updated imageOffset assignments for src/data/index.ts
    const lines = people
      .map((p) => {
        const newVal = offsets[p.id];
        return `// id: ${p.id} - ${p.name}\nimageOffset: ${newVal},`;
      })
      .join("\n\n");
    const snippet = `/* Replace the imageOffset values in src/data/index.ts with: */\n\n${lines}\n`;
    try {
      await navigator.clipboard.writeText(snippet);
      alert("Patch copied to clipboard. Paste into src/data/index.ts where the people array is defined.");
    } catch (e) {
      // fallback: open a new window with the snippet
      window.prompt("Copy the patch below:", snippet);
    }
  };

  return (
    <section
      id="people"
      className="relative py-28 px-6 overflow-hidden"
      style={{
        background:
          "radial-gradient(ellipse at 50% 50%, rgba(132,204,22,0.08) 0%, transparent 60%), transparent",
      }}
    >
      <div className="max-w-7xl mx-auto relative z-10">
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">
            My World
          </p>
          <h2 className="section-title">Special People</h2>
          <p className="section-subtitle font-medium text-pink-800/80">
            The ones who make life more beautiful
          </p>
        </motion.div>

        <div className="flex flex-wrap justify-center gap-8">
          {people.map((person, i) => (
            <motion.div
              key={person.id}
              initial={{ opacity: 0, y: 40, rotate: i % 2 === 0 ? -3 : 3 }}
              whileInView={{ opacity: 1, y: 0, rotate: i % 2 === 0 ? -2 : 2 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.12, duration: 0.7 }}
              whileHover={{ y: -12, rotate: 0, scale: 1.05 }}
              className="relative cursor-default"
              style={{ width: "220px" }}
            >
              {editMode && (
                <div className="absolute right-0 top-0 p-2 z-20 bg-white/90 rounded-md shadow-md w-44 text-xs">
                  <label className="block font-semibold text-pink-700">Offset</label>
                  <input
                    type="range"
                    min={-400}
                    max={200}
                    value={offsets[person.id] ?? 0}
                    onChange={(e) => updateOffset(person.id, Number(e.target.value))}
                    className="w-full"
                  />
                  <div className="mt-1 text-right text-pink-700 font-mono">{offsets[person.id] ?? 0}px</div>
                </div>
              )}
              <div
                className="relative p-4 pb-16 rounded-2xl border border-pink-200 overflow-hidden bg-white"
                style={{
                  boxShadow: "0 10px 30px rgba(132,204,22,0.06), 0 0 20px rgba(244,114,182,0.05)",
                }}
              >
                <div className="relative w-full rounded-xl overflow-hidden bg-pink-50 mb-4 border border-pink-100" style={{ minHeight: 260 }}>
                  {person.image ? (
                    (() => {
                      const off = typeof person.imageOffset === "number" ? person.imageOffset : 0;
                      // If offset is negative, extend the top so the image can sit higher without leaving gap
                      const style: React.CSSProperties = off < 0
                        ? { position: "absolute", top: `${off}px`, left: 0, right: 0, bottom: 0 }
                        : { position: "absolute", inset: 0, transform: `translateY(${off}px)` };

                      return (
                        <div style={style}>
                          <Image
                            src={person.image}
                            alt={person.name}
                            fill
                            className="object-cover"
                            style={{ objectPosition: person.objectPosition || "top center" }}
                            sizes="(max-width: 640px) 220px, 300px"
                          />
                        </div>
                      );
                    })()
                  ) : (
                    <div className="w-full h-full flex items-center justify-center">
                      <span className="text-7xl opacity-50">{person.name[0]}</span>
                    </div>
                  )}
                  <div className="absolute inset-0 bg-gradient-to-t from-pink-950/10 to-transparent" />
                </div>

                <div className="text-center">
                  <h3 className="font-display font-bold text-pink-950 text-base">
                    {person.name}
                  </h3>
                  <p className="text-pink-700/80 text-xs mt-0.5 font-bold">
                    {typeLabels[person.type]}
                  </p>
                </div>

                <div className="absolute inset-0 bg-white/95 rounded-2xl flex items-center justify-center p-5 opacity-0 hover:opacity-100 transition-opacity duration-300 border border-pink-300">
                  <div className="text-center">
                    <p className="text-pink-950 text-xs font-semibold leading-relaxed">
                      {person.description}
                    </p>
                    <p className="text-pink-700 text-xs mt-3 font-bold">
                      {typeLabels[person.type]}
                    </p>
                  </div>
                </div>
              </div>

              <div
                className="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-6 rounded-sm opacity-25"
                style={{ background: "rgba(132,204,22,0.4)" }}
              />
            </motion.div>
          ))}
        </div>

        <motion.p
          {...fadeUp(0.5)}
          className="text-center text-pink-700/60 text-sm mt-16 italic font-semibold"
        >
          &quot;The people you love are the greatest gift of all&quot;
        </motion.p>
      </div>
    </section>
  );
}
