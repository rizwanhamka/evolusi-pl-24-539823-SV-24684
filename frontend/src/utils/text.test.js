import { describe, it, expect } from "vitest";
import { truncateText } from "./text";

describe("truncateText", () => {
    it("mengembalikan teks asli jika panjang kurang dari batas", () => {
        expect(truncateText("Halo dunia", 50)).toBe("Salah");
    });

    it("memotong teks jika melebihi batas dan menambahkan ...", () => {
        const panjang = "a".repeat(60);
        expect(truncateText(panjang, 50)).toBe("a".repeat(50) + "...");
    });
});
