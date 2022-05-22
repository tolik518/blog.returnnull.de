export class Type4B5B
{
    private static get4b5bMap(): Map<string, string>
    {
        const keys: string[] = ["0000", "0001", "0010", "0011", "0100", "0101", "0110", "0111", //0 - 7
                                "1000", "1001", "1010", "1011", "1100", "1101", "1110", "1111",//8-F
                                "[_H]",   "[_I]",  "[_J]",  "[_K]",  "[_L]",  "[_Q]",  "[_R]",  "[_S]",  "[_T]"]; //Command Characters
        const values: string[] = ["11110", "01001", "10100", "10101", "01010", "01011", "01110", "01111", //0 - 7
                                  "10010", "10011", "10110", "10111", "11010", "11011", "11100", "11101", //8-F
                                  "00100", "11111", "11000", "10001", "00110", "00000", "00111", "11001", "01101"]; //Command Characters

        const bmap: Map<string,string> = new Map();

        for(let i = 0; i < keys.length; i++)
        {
            bmap.set(keys[i], values[i]);
        }

        return bmap;
    }

    public static fromBinary(binary: string): string
    {
        const map: Map<string, string> = this.get4b5bMap();
        let output: string = "";

        if (binary.includes(' ')) //Annahme: wenn Leerzeichen, dann in 4er Blocks aufgeteilt
        {
            let strArray: string[] = binary.match(/.{1,5}/g);
            strArray = strArray || [""]; //wenn strArray ist null oder undefined, dann setz auf leeres array

            strArray.forEach(function (item: string)
            {
                output += map.get(item.trim()) == undefined ? "" : map.get(item.trim())+" ";
            })
        }
        else
        {
            let strArray: string[]  = binary.match(/.{1,4}/g);
            strArray = strArray || [""]; //wenn strArray ist null oder undefined, dann setz auf leeres array

            strArray.forEach(function (item: string)
            {
                output += map.get(item) == undefined ? "" : map.get(item);
            })
        }

        return output.trim();
    }

    public static fromMLT3(codemlt3: string):string
    {
        let output: string = "";
        if (codemlt3 == "")
        {
            output = "";
        } else {
            let codemlt3array: string[] = codemlt3.replace(/\s/g, '').match(/./g);
            let lastsymbol: string[] = ["0"].concat(codemlt3array); //mlt3 always starting with a 0 on the index [-1]

            for(let i: number = 0; i < codemlt3array.length; i++)
            {
                if(codemlt3array[i] == lastsymbol[i]){
                    output+= "0";
                } else if(codemlt3array[i] == " ") {
                    output += " ";
                } else {
                    output += "1";
                }
            }
        }
        return output.replace(/\d{5}(?=.)/g, '$& ').trim();
    }
}