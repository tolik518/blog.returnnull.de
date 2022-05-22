import {Type4B5B} from "./Type4B5B";

export class TypeBinary
{
    public static fromAscii(ascii: string): string
    {
        let binary: string[] = ascii.split('') //https://stackoverflow.com/a/38362821
            .map((char: any) => '00'.concat(char.charCodeAt(0).toString(2)).slice(-8))
            .join('').match(/.{4}/g);
        binary = binary || [""]; //wenn binary ist null oder undefined, dann setz auf leeres array

        let output: string = "";

        binary.forEach(function (bytes: string) {
            output+= bytes + " ";
        })
        return output.trim();
    }

    public static fromHex(hex: string): string
    {

        let binary: string[] = hex.replace(/\s/g, '').match(/.{1,2}/g);

        binary = binary || [""]; //wenn binary ist null oder undefined, dann setz auf leeres array
        let output: string = "";

        if(binary[0] != "")
        {
            binary.forEach(function (bytes: string) {
                output+= TypeBinary.hex2bin(bytes).replace(/\d{4}(?=.)/g, '$& ') + " ";
            })
        }

        return output.trim();
    }

    private static get4b5bMap(): Map<string, string>
    {
        const keys: string[] =   ["11110", "01001", "10100", "10101", "01010", "01011", "01110", "01111", //0 - 7
                                  "10010", "10011", "10110", "10111", "11010", "11011", "11100", "11101", //8-F
                                  "00100", "11111", "11000", "10001", "00110", "00000", "00111", "11001", "01101"]; //Command Characters

        const values: string[] = ["0000", "0001", "0010", "0011", "0100", "0101", "0110", "0111", //0 - 7
                                  "1000", "1001", "1010", "1011", "1100", "1101", "1110", "1111",//8-F
                                  "[_H]",   "[_I]",  "[_J]",  "[_K]",  "[_L]",  "[_Q]",  "[_R]",  "[_S]",  "[_T]"]; //Command Characters

        const bmap: Map<string,string> = new Map();

        for(let i = 0; i < keys.length; i++)
        {
            bmap.set(keys[i], values[i]);
        }

        return bmap;
    }

    public static from4B5B(code4b5b: string): string
    {
        let output: string = "";

        if(code4b5b == "")
        {
            output = "";
        } else {
            const map: Map<string, string> = this.get4b5bMap();

            let strArray: string[] = code4b5b.match(/.{1,6}/g);
            strArray = strArray || [""]; //wenn strArray ist null oder undefined, dann setz auf leeres array

            strArray.forEach(function (item: string)
            {
                output += map.get(item.trim()) == undefined ? "????"+" " : map.get(item.trim())+" ";
            })
        }

        return output;
    }

    private static hex2bin(hex: string): string
    {
        return (parseInt(hex, 16).toString(2)).padStart(8, '0'); //https://stackoverflow.com/a/45054052
    }
}
