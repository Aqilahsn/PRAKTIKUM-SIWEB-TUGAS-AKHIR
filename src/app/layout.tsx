import type { Metadata } from "next";
import { Inter, Playfair_Display, JetBrains_Mono } from "next/font/google";
import "./globals.css";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import SakuraPetals from "@/components/SakuraPetals";
import SmoothScroll from "@/components/SmoothScroll";

const inter = Inter({
  subsets: ["latin"],
  variable: "--font-inter",
  display: "swap",
});

const playfair = Playfair_Display({
  subsets: ["latin"],
  variable: "--font-playfair",
  display: "swap",
});

const jetbrains = JetBrains_Mono({
  subsets: ["latin"],
  variable: "--font-jetbrains",
  display: "swap",
});

export const metadata: Metadata = {
  title: "Aqilah Nur Afifah — Frontend Developer Portfolio",
  description:
    "Portfolio of Aqilah Nur Afifah, a passionate Frontend Developer specializing in React, Next.js, and elegant UI design. Based in Bandung, Indonesia.",
  keywords: [
    "Frontend Developer",
    "React",
    "Next.js",
    "Tailwind CSS",
    "Portfolio",
    "Bandung",
    "UI Design",
    "Web Developer Indonesia",
  ],
  authors: [{ name: "Aqilah Nur Afifah" }],
  openGraph: {
    title: "Aqilah Nur Afifah — Frontend Developer Portfolio",
    description: "Crafting elegant digital experiences with passion & precision.",
    type: "website",
  },
  twitter: {
    card: "summary_large_image",
    title: "Aqilah Nur Afifah — Frontend Developer",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en" className={`${inter.variable} ${playfair.variable} ${jetbrains.variable}`}>
      <body className="bg-[#0a0006] text-pink-200 overflow-x-hidden">
        <SmoothScroll />
        <SakuraPetals />
        <Navbar />
        <main>{children}</main>
        <Footer />
      </body>
    </html>
  );
}
