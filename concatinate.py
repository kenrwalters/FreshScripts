import os
import argparse

# concantenate files 
def concatenate_files(source_dir, output_file):
    # Open the output file in write mode
    with open(output_file, 'w', encoding='utf-8') as outfile:
        # Iterate through all files in the source directory
        firstFile = True
        for filename in os.listdir(source_dir):
            source_path = os.path.join(source_dir, filename)
            
            # only add the header row from the first one 
            # Check if it's a file
            if os.path.isfile(source_path):
                # Read content from the current file
                sourceCount = 0
                copiedCount = 0
                with open(source_path, 'r', encoding='utf-8') as infile:
                    for line in infile:
                        sourceCount += 1
                        if sourceCount == 1:
                            print(f"{source_path} line 1")
                            # only write the column headers for the first
                            if firstFile == True:
                                outfile.write(line)
                                firstFile = False
                                continue
                            else:
                                continue
                        
                        # write data line
                        outfile.write(line)
                        copiedCount += 1
                        
                print(f"Added {copiedCount} from {filename} to {output_file}")

def main():
    # Set up argument parser
    parser = argparse.ArgumentParser(description="Concatenate contents of all text files in a directory into a single file.")
    parser.add_argument("source_dir", help="Path to the source directory containing text files.")
    parser.add_argument("output_file", help="Path to the output file where concatenated contents will be written.")
    args = parser.parse_args()

    # Call the concatenate_files function with parsed arguments
    concatenate_files(args.source_dir, args.output_file)

if __name__ == "__main__":
    main()
