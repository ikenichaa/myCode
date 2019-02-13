public class CPULoader implements Runnable {
	private String name;
	public CPULoader(String str){
		this.name =str;
	}
	public void run() { 
	double x = 1.0; 
	while (true){
		x = x + 1.0;
		//System.out.println(name+x);
		}
	}
public static void main(String[] args) {
	int numCores = Runtime.getRuntime().availableProcessors();
	System.out.println(numCores);
	for (int i=0; i < numCores; i++) {
		String n = Integer.toString(i);
		Thread threads = new Thread(new CPULoader(n+"--"));
		threads.start();
		
		} 
	}
}