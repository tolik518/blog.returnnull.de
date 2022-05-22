import {TypeASCII}  from "./Types/TypeASCII.js";
import {TypeHex}    from "./Types/TypeHex.js";
import {TypeBinary} from "./Types/TypeBinary.js";
import {Type4B5B}   from "./Types/Type4B5B.js";
import {TypeMLT3}   from "./Types/TypeMLT3.js";

class converter
{

    public static writeConvertedASCII(this: HTMLInputElement) :void
    {
        let ascii: string = this.value;
        elementASCII.value = ascii;

        let binary: string = TypeBinary.fromAscii(ascii);
        elementBinary.value = binary;

        let hex: string = TypeHex.fromAscii(ascii);
        elementHex.value = hex;

        let code4b5b: string = Type4B5B.fromBinary(binary);
        element4B5B.value = code4b5b;

        let codemlt3: string = TypeMLT3.from4B5B(code4b5b);
        elementMLT3.value = codemlt3;
    }

    public static writeConvertedHex(this: HTMLInputElement):void
    {
        let hex: string = this.value;
        elementHex.value = hex;

        let ascii: string  = TypeASCII.fromHex(hex);
        elementASCII.value = ascii;

        let binary: string  = TypeBinary.fromHex(hex);
        elementBinary.value = binary;

        let code4b5b: string = Type4B5B.fromBinary(binary);
        element4B5B.value = code4b5b;

        let codemlt3: string = TypeMLT3.from4B5B(code4b5b);
        elementMLT3.value = codemlt3;
    }

    public static writeConvertedBinary(this: HTMLInputElement): void
    {
        let binary: string = this.value;
        elementBinary.value = binary;

        let hex: string = TypeHex.fromBinary(binary);
        elementHex.value = hex;

        let ascii: string  = TypeASCII.fromHex(hex);
        elementASCII.value = ascii;

        let code4b5b: string = Type4B5B.fromBinary(binary);
        element4B5B.value = code4b5b;

        let codemlt3: string = TypeMLT3.from4B5B(code4b5b);
        elementMLT3.value = codemlt3;
    }

    public static  writeConverted4B5B(this: HTMLInputElement): void
    {
        let code4b5b: string = this.value;
        element4B5B.value = code4b5b;

        let binary: string  = TypeBinary.from4B5B(code4b5b);
        elementBinary.value = binary;

        let hex: string = TypeHex.fromBinary(binary);
        elementHex.value = hex;

        let ascii: string  = TypeASCII.fromHex(hex);
        elementASCII.value = ascii;

        let codemlt3: string = TypeMLT3.from4B5B(code4b5b);
        elementMLT3.value = codemlt3;
    }

    public static writeConvertedMLT3(this: HTMLInputElement): void
    {
        let codemlt3: string = this.value;
        elementMLT3.value = codemlt3;

        let code4b5b: string = Type4B5B.fromMLT3(codemlt3);
        element4B5B.value = code4b5b;

        let binary: string  = TypeBinary.from4B5B(code4b5b);
        elementBinary.value = binary;

        let hex: string = TypeHex.fromBinary(binary);
        elementHex.value = hex;

        let ascii: string  = TypeASCII.fromHex(hex);
        elementASCII.value = ascii;
    }
}

const elementASCII: HTMLInputElement = <HTMLInputElement>document.getElementById("ascii");
elementASCII.addEventListener("input", converter.writeConvertedASCII, false);

const elementHex: HTMLInputElement = <HTMLInputElement>document.getElementById("hex");
elementHex.addEventListener("input", converter.writeConvertedHex, false);

const elementBinary: HTMLInputElement = <HTMLInputElement>document.getElementById("binary");
elementBinary.addEventListener("input", converter.writeConvertedBinary, false);

const element4B5B: HTMLInputElement = <HTMLInputElement>document.getElementById("4B5B");
element4B5B.addEventListener("input", converter.writeConverted4B5B, false);

const elementMLT3: HTMLInputElement = <HTMLInputElement>document.getElementById("MLT3");
elementMLT3.addEventListener("input", converter.writeConvertedMLT3, false);