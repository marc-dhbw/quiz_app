{
  description = "A very basic flake";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-24.11";  # Use the latest stable version or your desired branch
    };

    outputs = { self, nixpkgs }: 
        let
            pkgs = import nixpkgs { inherit system; };
            system = "x86_64-linux";
        in{

            devShell.${system} = pkgs.mkShell {
                buildInputs = [ pkgs.docker-compose ];
                shellHook = ''
                    echo Hello devShell
                    docker-compose up -d
                '';
            };
        };

}
